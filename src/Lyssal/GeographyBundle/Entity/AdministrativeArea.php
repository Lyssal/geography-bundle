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
 * Région d'un country.
 *
 * @author Rémi Leclerc
 * @ORM\MappedSuperclass
 */
abstract class AdministrativeArea
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
     * @var \Lyssal\GeographyBundle\Entity\Country The country
     *
     * @ORM\ManyToOne(targetEntity="Country", inversedBy="administrativeAreas")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    protected $country;

    /**
     * @var array<\Lyssal\GeographyBundle\Entity\SubAdministrativeArea> The sub-administrative areas
     *
     * @ORM\OneToMany(targetEntity="SubAdministrativeArea", mappedBy="administrativeArea")
     */
    protected $subAdministrativeAreas;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->subAdministrativeAreas = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return AdministrativeArea
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
     * Set country
     *
     * @param \Lyssal\GeographyBundle\Entity\Country $country
     * @return AdministrativeArea
     */
    public function setCountry(\Lyssal\GeographyBundle\Entity\Country $country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return \Lyssal\GeographyBundle\Entity\Country
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Add subAdministrativeAreas
     *
     * @param \Lyssal\GeographyBundle\Entity\SubAdministrativeArea $subAdministrativeAreas
     * @return AdministrativeArea
     */
    public function addSubAdministrativeArea(\Lyssal\GeographyBundle\Entity\SubAdministrativeArea $subAdministrativeAreas)
    {
        $this->subAdministrativeAreas[] = $subAdministrativeAreas;

        return $this;
    }

    /**
     * Remove subAdministrativeAreas
     *
     * @param \Lyssal\GeographyBundle\Entity\SubAdministrativeArea $subAdministrativeAreas
     */
    public function removeSubAdministrativeArea(\Lyssal\GeographyBundle\Entity\SubAdministrativeArea $subAdministrativeAreas)
    {
        $this->subAdministrativeAreas->removeElement($subAdministrativeAreas);
    }

    /**
     * Get subAdministrativeAreas
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSubAdministrativeAreas()
    {
        return $this->subAdministrativeAreas;
    }


    /**
     * ToString.
     *
     * @return string Nom de la région
     */
    public function __toString()
    {
        return $this->getName();
    }
}
