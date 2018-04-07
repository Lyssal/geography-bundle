<?php
/**
 * This file is part of the Lyssal geography bundle.
 *
 * @copyright Rémi Leclerc
 * @author Rémi Leclerc
 */
namespace Lyssal\GeographyBundle\Command\Database;

use Lyssal\Exception\InvalidArgumentException;
use Lyssal\Geography\Code\Iso3166Hyphen1Alpha3;
use Lyssal\Geography\Code\Iso639Hyphen1;
use Lyssal\Geography\Exception\GeographyException;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Lyssal\Dsv\Csv;
use Lyssal\GeographyBundle\Entity\Country;
use Symfony\Component\Console\Command\Command;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Lyssal\GeographyBundle\Manager\PostalCodeManager;
use Lyssal\GeographyBundle\Manager\CountryManager;
use Lyssal\GeographyBundle\Manager\AdministrativeAreaManager;
use Lyssal\GeographyBundle\Manager\SubAdministrativeAreaManager;
use Lyssal\GeographyBundle\Manager\CityManager;

/**
 * Commande pour remplir la base de données.
 */
class FillCommand extends Command
{
    /**
     * @var \Symfony\Bridge\Doctrine\RegistryInterface Doctrine
     */
    private $doctrine;

    /**
     * @var \Lyssal\GeographyBundle\Manager\CountryManager The manager of Country
     */
    private $countryManager;

    /**
     * @var \Lyssal\GeographyBundle\Manager\AdministrativeAreaManager AdministrativeAreaManager
     */
    private $administrativeAreaManager;

    /**
     * @var \Lyssal\GeographyBundle\Manager\SubAdministrativeAreaManager SubAdministrativeAreaManager
     */
    private $subAdministrativeAreaManager;

    /**
     * @var \Lyssal\GeographyBundle\Manager\CityManager CityManager
     */
    private $cityManager;

    /**
     * @var \Lyssal\GeographyBundle\Manager\PostalCodeManager PostalCodeManager
     */
    private $postalCodeManager;

    /**
     * @var string Chemin vers le dossier de fichiers de LyssalGeographyBundle
     */
    private $filesPath;

    /**
     * @var array The French regions
     */
    private static $administrativeAreasFr = array
    (
        "Alsace-Champagne-Ardenne-Lorraine" => array('08', "10", "51", "52", "54", "55", "57", "67","68", "88"),
        "Auvergne-Rhône-Alpes" =>   array("01","03", "07", "15", "26", "38","42","43", "63", "69", "73", "74"),
        "Aquitaine-Limousin-Poitou-Charentes" =>  array("16","17", "19", "23", "24", "33", "40", "47", "64", "79", "86", "87"),
        "Bourgogne-Franche-Comté" => array("21", "25", "39", "58", "70", "71", "89", "90"),
        "Bretagne" => array("22", "29", "35", "56"),
        "Centre-Val de Loire" => array("18", "28", "36", "37", "41", "45"),
        "Corse" => array("2A", "2B"),
        "Île-de-France" => array("75", "76", "77", "78", "91", "92", "93", "94", "95"),
        "Languagedoc-Roussillon-Midi-Pyrénées" => array("09", "11", "12", "30", "31", "32", "34", "46", "48", "65", "66", "81", "82"),
        "Nord-Pas-de-Calais-Picardie" => array("02", "59", "60", "62", "80"),
        "Normandie" => array("14", "27", "50", "61", "76"),
        "Pays de la Loire" => array("44", "49", "53", "72", "85"),
        "Provence-Alpes-Côte d'Azur" => array("04", "05", "06", "13", "83", "84"),
        "Guadeloupe" => array("971"),
        "Martinique" => array("972"),
        "Guyane" => array("973"),
        "La Réunion" => array("974"),
        "Mayotte" => array("976"),
    );


    /**
     * Constructeur
     *
     * @param \Symfony\Bridge\Doctrine\RegistryInterface $doctrine Doctrine
     * @param \Lyssal\GeographyBundle\Manager\CountryManager $countryManager CountryManager
     * @param \Lyssal\GeographyBundle\Manager\AdministrativeAreaManager $administrativeAreaManager AdministrativeAreaManager
     * @param \Lyssal\GeographyBundle\Manager\SubAdministrativeAreaManager $subAdministrativeAreaManager SubAdministrativeAreaManager
     * @param \Lyssal\GeographyBundle\Manager\CityManager $cityManager CityManager
     * @param \Lyssal\GeographyBundle\Manager\PostalCodeManager $postalCodeManager PostalCodeManager
     */
    public function __construct(RegistryInterface $doctrine,
        CountryManager $countryManager,
        AdministrativeAreaManager $administrativeAreaManager,
        SubAdministrativeAreaManager $subAdministrativeAreaManager,
        CityManager $cityManager,
        PostalCodeManager $postalCodeManager
    ) {
        $this->doctrine = $doctrine;
        $this->countryManager = $countryManager;
        $this->administrativeAreaManager = $administrativeAreaManager;
        $this->subAdministrativeAreaManager = $subAdministrativeAreaManager;
        $this->cityManager = $cityManager;
        $this->postalCodeManager = $postalCodeManager;

        parent::__construct();
    }


    /**
     * (non-PHPdoc)
     * @see \Symfony\Component\Console\Command\Command::configure()
     */
    protected function configure()
    {
        $this
            ->setName('lyssal:geography:database:fill')
            ->setDescription('Fill the geographic data in the database')
            ->addOption('locale', 'l', InputOption::VALUE_REQUIRED, 'The locale (fr, en)')
        ;
    }

    /**
     * {@inheritdoc}
     *
     * @param InputInterface  $input  An InputInterface instance
     * @param OutputInterface $output An OutputInterface instance
     *
     * @throws \Lyssal\Exception\InvalidArgumentException If the locale argument is missing
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->doctrine->getConnection()->getConfiguration()->setSQLLogger(null);
        $this->initFilesPath();
        $locale = $input->getOption('locale');

        if (!in_array($locale, [Iso639Hyphen1::FRENCH, Iso639Hyphen1::ENGLISH], true)) {
            throw new InvalidArgumentException('Please choose a locale among ['.Iso639Hyphen1::FRENCH.', '.Iso639Hyphen1::ENGLISH.'].');
        }

        $this->importeCountries($locale);
    }

    /**
     * Initialise le chemin vers le dossier de fichiers de LyssalGeographyBundle.
     *
     * @return void
     */
    private function initFilesPath()
    {
        $reflector = new \ReflectionClass(GeographyException::class);
        $this->filesPath = dirname($reflector->getFileName()).DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'files';
    }

    /**
     * Import all countries.
     *
     * @param string $locale The locale
     */
    private function importeCountries($locale)
    {
        $csvFile = new Csv($this->filesPath.DIRECTORY_SEPARATOR.'csv'.DIRECTORY_SEPARATOR.'countries.csv', ',', '"');
        $csvFile->import(false);

        $this->cityManager->removeAll(true);
        $this->countryManager->removeAll(true);
        $this->administrativeAreaManager->initAutoIncrement();
        $this->subAdministrativeAreaManager->initAutoIncrement();
        $this->postalCodeManager->initAutoIncrement();

        foreach ($csvFile->getLines() as $csvLine) {
            $codeAlpha2 = $csvLine[2];
            $codeAlpha3 = $csvLine[3];
            $names = [
                Iso639Hyphen1::FRENCH => $csvLine[4],
                Iso639Hyphen1::ENGLISH => $csvLine[5]
            ];

            $country = $this->countryManager->new();
            $country->setCodeAlpha2($codeAlpha2);
            $country->setCodeAlpha3($codeAlpha3);
            $country->setName($names[$locale]);
            $this->countryManager->persist($country);

            if (Iso3166Hyphen1Alpha3::FRANCE === $codeAlpha3) {
                $this->importFranceRegions($country);
                $this->importFranceDepartements($country);
                $this->importFranceCities($country);
            }
        }

        $this->countryManager->flush();
    }

    /**
     * Import the French regions.
     *
     * @param \Lyssal\GeographyBundle\Entity\Country $countryFrance France
     */
    private function importFranceRegions(Country $countryFrance)
    {
        $administrativeAreasNamesFr = array_keys(self::$administrativeAreasFr);

        foreach ($administrativeAreasNamesFr as $administrativeAreaName) {
            $administrativeArea = $this->administrativeAreaManager->create();

            $administrativeArea->setName($administrativeAreaName);
            $administrativeArea->setCountry($countryFrance);

            $this->administrativeAreaManager->persist($administrativeArea);
        }

        $this->administrativeAreaManager->flush();
    }

    /**
     * Import the French departments.
     *
     * @param \Lyssal\GeographyBundle\Entity\Country $countryFrance France
     */
    private function importFranceDepartements(Country $countryFrance)
    {
        $csvFile = new Csv($this->filesPath.DIRECTORY_SEPARATOR.'csv'.DIRECTORY_SEPARATOR.'france-departements.csv', ',', '"');
        $csvFile->import(false);

        foreach ($csvFile->getLines() as $csvLine) {
            $code = strtoupper($csvLine[1]);
            $nameFr = $csvLine[2];

            $department = $this->subAdministrativeAreaManager->create();

            $department->setCode($code);
            $department->setAdministrativeArea($this->getFranceRegionByDepartment($code, $countryFrance));
            $department->setName($nameFr);

            $this->subAdministrativeAreaManager->persist($department);
        }

        $this->subAdministrativeAreaManager->flush();
    }

    /**
     * Get the French region by departement code.
     *
     * @param string                                 $departmentCodeToFind The code of the department
     * @param \Lyssal\GeographyBundle\Entity\Country $countryFrance        France
     * @return \Lyssal\GeographyBundle\Entity\AdministrativeArea The region
     *
     * @throws \Lyssal\Geography\Exception\GeographyException If the region has not been found
     */
    private function getFranceRegionByDepartment($departmentCodeToFind, Country $countryFrance)
    {
        $departmentName = null;

        foreach (self::$administrativeAreasFr as $testedRegionName => $departmentCodes) {
            foreach ($departmentCodes as $departmentCode) {
                if ($departmentCode === $departmentCodeToFind) {
                    $departmentName = $testedRegionName;
                    break;
                }
            }
            if (null !== $departmentName) {
                break;
            }
        }

        if (null === $departmentName) {
            throw new GeographyException('The French region has not been found for the department with code "'.$departmentCodeToFind.'".');
        }

        return $this->administrativeAreaManager->findOneBy(array('name' => $departmentName, 'country' => $countryFrance));
    }

    /**
     * Import the French cities.
     *
     * @param \Lyssal\GeographyBundle\Entity\Country $countryFrance France
     *
     * @throws \Lyssal\Geography\Exception\GeographyException If the city's department has not been found
     */
    private function importFranceCities($countryFrance)
    {
        $departmentsByCode = array();
        foreach ($this->subAdministrativeAreaManager->findByCountry($countryFrance) as $department) {
            $departmentsByCode[$department->getCode()] = $department;
        }

        $csvFile = new Csv($this->filesPath.DIRECTORY_SEPARATOR.'csv'.DIRECTORY_SEPARATOR.'cities-france.csv', ',', '"');
        $csvFile->import(false);

        $count = 0;
        foreach ($csvFile->getLines() as $csvLine) {
            $departmentCode = (strlen($csvLine[1]) < 2 ? '0' : '').strtoupper($csvLine[1]);

            if ('975' !== $departmentCode) {
                if (!isset($departmentsByCode[$departmentCode])) {
                    throw new GeographyException('The department code\'s city "'.$csvLine[1].'" has not been found.');
                }

                $department = $departmentsByCode[$departmentCode];
                $nameFr = $csvLine[5];
                $postalCodeCodes = explode('-', $csvLine[8]);
                $code = $csvLine[10];
                $longitude = (float) ($csvLine[19]);
                $latitude = (float) ($csvLine[20]);

                $city = $this->cityManager->create();
                $city->setSubAdministrativeArea($department);
                foreach ($postalCodeCodes as $postalCodeCode) {
                    $postalCode = $this->postalCodeManager->create();
                    $postalCode->setCode($postalCodeCode);
                    $city->addPostalCode($postalCode);
                }
                $city->setCode($code);
                $city->setLatitude($latitude);
                $city->setLongitude($longitude);

                $city->setName($nameFr);

                $this->cityManager->persist($city);

                if (++$count % 1000 == 0) {
                    $this->cityManager->flush();
                    $this->cityManager->clear();
                    $this->postalCodeManager->clear();
                }
            }
        }

        if (++$count % 1000 === 0) {
            $this->cityManager->flush();
        }
    }
}
