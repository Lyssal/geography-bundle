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
 * Département d'une région.
 *
 * @ORM\MappedSuperclass
 */
abstract class SubAdministrativeArea
{
    /**
     * @var integer The ID
     *
     * @ORM\Column(type="integer", nullable=false, options={"unsigned":true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \Lyssal\GeographyBundle\Entity\AdministrativeArea The administrative area
     *
     * @ORM\ManyToOne(targetEntity="AdministrativeArea", inversedBy="subAdministrativeAreas")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    protected $administrativeArea;

    /**
     * @var string The name
     *
     * @ORM\Column(type="string", nullable=false, length=128)
     * @Assert\NotBlank
     */
    protected $name;

    /**
     * @var string The code
     *
     * @ORM\Column(type="string", nullable=true, length=3)
     */
    protected $code;

    /**
     * @var array<\Lyssal\GeographyBundle\Entity\City> The cities
     *
     * @ORM\OneToMany(targetEntity="City", mappedBy="departement")
     */
    protected $cities;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->cities = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return SubAdministrativeArea
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
     * Set administrativeArea
     *
     * @param \Lyssal\GeographyBundle\Entity\AdministrativeArea $administrativeArea
     * @return SubAdministrativeArea
     */
    public function setAdministrativeArea(\Lyssal\GeographyBundle\Entity\AdministrativeArea $administrativeArea)
    {
        $this->administrativeArea = $administrativeArea;

        return $this;
    }

    /**
     * Get administrativeArea
     *
     * @return \Lyssal\GeographyBundle\Entity\AdministrativeArea
     */
    public function getAdministrativeArea()
    {
        return $this->administrativeArea;
    }

    /**
     * Set code
     *
     * @param string $code
     * @return SubAdministrativeArea
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
     * Add cities
     *
     * @param \Lyssal\GeographyBundle\Entity\City $cities
     * @return SubAdministrativeArea
     */
    public function addCity(\Lyssal\GeographyBundle\Entity\City $cities)
    {
        $this->cities[] = $cities;

        return $this;
    }

    /**
     * Remove cities
     *
     * @param \Lyssal\GeographyBundle\Entity\City $cities
     */
    public function removeCity(\Lyssal\GeographyBundle\Entity\City $cities)
    {
        $this->cities->removeElement($cities);
    }

    /**
     * Get cities
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCities()
    {
        return $this->cities;
    }


    /**
     * ToString.
     *
     * @return string Name du département
     */
    public function __toString()
    {
        return $this->getName();
    }
}
