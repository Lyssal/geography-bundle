<?php
/**
 * This file is part of the Lyssal geography bundle.
 *
 * @copyright Rémi Leclerc
 * @author Rémi Leclerc
 */
namespace Lyssal\GeographyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * City.
 *
 * @author Rémi Leclerc
 * @ORM\MappedSuperclass
 */
abstract class City
{
    /**
     * @var integer The ID
     *
     * @ORM\Column(type="integer", nullable=false, options={"unsigned":true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string The name
     *
     * @ORM\Column(type="string", nullable=false, length=128)
     * @Assert\NotBlank
     */
    protected $name;

    /**
     * @var \Lyssal\GeographyBundle\Entity\SubAdministrativeArea The sub-administrative area
     *
     * @ORM\ManyToOne(targetEntity="SubAdministrativeArea", inversedBy="citys")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    protected $subAdministrativeArea;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection The postal codes
     *
     * @ORM\ManyToMany(targetEntity="PostalCode", mappedBy="cities", cascade={"persist"})
     */
    protected $postalCodes;

    /**
     * @var string The code
     *
     * @ORM\Column(type="string", nullable=true, length=5)
     */
    protected $code;

    /**
     * @var number The latitude
     *
     * @ORM\Column(type="decimal", nullable=true, precision=10, scale=8)
     */
    protected $latitude;

    /**
     * @var number The longitude
     *
     * @ORM\Column(type="decimal", nullable=true, precision=10, scale=8)
     */
    protected $longitude;

    /**
     * @var string The description
     *
     * @ORM\Column(type="string", nullable=true, length=255)
     */
    protected $description;

    /**
     * @var string The website
     *
     * @ORM\Column(type="string", nullable=true, length=128)
     */
    protected $website;

    /**
     * @var string The gentile
     *
     * @ORM\Column(type="string", nullable=true, length=32)
     */
    protected $gentile;


    /**
     * Constructeur.
     */
    public function __construct()
    {
        $this->postalCodes = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return City
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set subAdministrativeArea
     *
     * @param \Lyssal\GeographyBundle\Entity\SubAdministrativeArea $subAdministrativeArea
     * @return City
     */
    public function setSubAdministrativeArea(\Lyssal\GeographyBundle\Entity\SubAdministrativeArea $subAdministrativeArea)
    {
        $this->subAdministrativeArea = $subAdministrativeArea;

        return $this;
    }

    /**
     * Get subAdministrativeArea
     *
     * @return \Lyssal\GeographyBundle\Entity\SubAdministrativeArea
     */
    public function getSubAdministrativeArea()
    {
        return $this->subAdministrativeArea;
    }

    /**
     * Set code
     *
     * @param string $code
     * @return City
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set latitude
     *
     * @param string $latitude
     * @return City
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Get latitude
     *
     * @return string
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set longitude
     *
     * @param string $longitude
     * @return City
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Get longitude
     *
     * @return string
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return City
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set website
     *
     * @param string $website
     * @return City
     */
    public function setWebsite($website)
    {
        $this->website = $website;

        return $this;
    }

    /**
     * Get website
     *
     * @return string
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * Set gentile
     *
     * @param string $gentile
     * @return City
     */
    public function setGentile($gentile)
    {
        $this->gentile = $gentile;

        return $this;
    }


    /**
     * Get gentile
     *
     * @return string
     */
    public function getGentile()
    {
        return $this->gentile;
    }


    /**
     * ToString.
     *
     * @return string Name de la city
     */
    public function __toString()
    {
        return $this->getName();
    }

    /**
     * Equals.
     *
     * @param \Lyssal\GeographyBundle\Entity\City $otherCity The city
     *
     * @return boolean Equals
     */
    public function equals(City $otherCity)
    {
        return ($this->id === $otherCity->getId());
    }
}
