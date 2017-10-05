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
 * Country du monde.
 *
 * @author Rémi Leclerc
 * @ORM\MappedSuperclass
 */
abstract class Country
{
    /**
     * @var integer The ID
     *
     * @ORM\Column(type="smallint", nullable=false, options={"unsigned":true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string The name
     *
     * @ORM\Column(type="string", nullable=false, length=128)
     * @Assert\NotBlank()
     */
    protected $name;

    /**
     * @var string The code alpha 2
     *
     * @ORM\Column(type="string", nullable=true, length=2)
     */
    protected $codeAlpha2;

    /**
     * @var string The code alpha 3
     *
     * @ORM\Column(type="string", nullable=true, length=3)
     */
    protected $codeAlpha3;

    /**
     * @var \Doctrine\Common\Collections\Collection The administrative areas
     *
     * @ORM\OneToMany(targetEntity="AdministrativeArea", mappedBy="country")
     */
    protected $administrativeAreas;

    /**
     * @var \Doctrine\Common\Collections\Collection The languages
     *
     * @ORM\OneToMany(targetEntity="Language", mappedBy="country")
     */
    protected $languages;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->administrativeAreas = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Country
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
     * Set codeAlpha2
     *
     * @param string $codeAlpha2
     * @return Country
     */
    public function setCodeAlpha2($codeAlpha2)
    {
        $this->codeAlpha2 = $codeAlpha2;

        return $this;
    }

    /**
     * Get codeAlpha2
     *
     * @return string
     */
    public function getCodeAlpha2()
    {
        return $this->codeAlpha2;
    }

    /**
     * Set codeAlpha3
     *
     * @param string $codeAlpha3
     * @return Country
     */
    public function setCodeAlpha3($codeAlpha3)
    {
        $this->codeAlpha3 = $codeAlpha3;

        return $this;
    }

    /**
     * Get codeAlpha3
     *
     * @return string
     */
    public function getCodeAlpha3()
    {
        return $this->codeAlpha3;
    }

    /**
     * Add administrativeAreas
     *
     * @param \Lyssal\GeographyBundle\Entity\AdministrativeArea $administrativeAreas
     * @return \Lyssal\GeographyBundle\Entity\Country
     */
    public function addAdministrativeArea(\Lyssal\GeographyBundle\Entity\AdministrativeArea $administrativeAreas)
    {
        $this->administrativeAreas[] = $administrativeAreas;

        return $this;
    }

    /**
     * Remove administrativeAreas
     *
     * @param \Lyssal\GeographyBundle\Entity\AdministrativeArea $administrativeAreas
     */
    public function removeAdministrativeArea(\Lyssal\GeographyBundle\Entity\AdministrativeArea $administrativeAreas)
    {
        $this->administrativeAreas->removeElement($administrativeAreas);
    }

    /**
     * Get administrativeAreas
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAdministrativeAreas()
    {
        return $this->administrativeAreas;
    }

    /**
     * Add language
     *
     * @param \Lyssal\GeographyBundle\Entity\Language $language
     * @return \Lyssal\GeographyBundle\Entity\Country
     */
    public function addLanguage(\Lyssal\GeographyBundle\Entity\Language $language)
    {
        $this->languages[] = $language;

        return $this;
    }

    /**
     * Remove languages
     *
     * @param \Lyssal\GeographyBundle\Entity\Language $language
     */
    public function removeLanguage(\Lyssal\GeographyBundle\Entity\Language $language)
    {
        $this->languages->removeElement($language);
    }

    /**
     * Get languages
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLanguages()
    {
        return $this->languages;
    }



    /**
     * ToString.
     *
     * @return string Name du country
     */
    public function __toString()
    {
        return $this->getName();
    }
}
