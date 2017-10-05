<?php
/**
 * This file is part of the Lyssal geography bundle.
 *
 * @copyright Rémi Leclerc
 * @author Rémi Leclerc
 */
namespace Lyssal\GeographyBundle\Repository;

use Lyssal\Doctrine\Orm\Repository\EntityRepository;
use Lyssal\GeographyBundle\Entity\Country;

/**
 * The repository of SubAdministrativeArea.
 */
class SubAdministrativeAreaRepository extends EntityRepository
{
    /**
     * Get the sub administrative areas of a country.
     *
     * @param \Lyssal\GeographyBundle\Entity\Country $country The country
     * @return \Doctrine\Common\Collections\ArrayCollection The sub administrative areas of the country
     */
    public function findByCountry(Country $country)
    {
        $requete = $this->createQueryBuilder('subAdministrativeArea');

        $requete
            ->innerJoin('subAdministrativeArea.administrativeArea', 'administrativeArea')
            ->addSelect('administrativeArea')
            ->where('administrativeArea.country = :country')
            ->setParameter('country', $country)
        ;

        return $requete->getQuery()->getResult();
    }
}
