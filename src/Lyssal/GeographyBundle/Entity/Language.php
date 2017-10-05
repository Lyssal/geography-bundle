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
 * Language.
 *
 * @author Rémi Leclerc
 * @ORM\MappedSuperclass()
 */
abstract class Language
{
    /**
     * @var integer The ID
     *
     * @ORM\Column(type="smallint", nullable=false, options={"unsigned":true})
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string The name
     *
     * @ORM\Column(type="string", nullable=false, length=32)
     * @Assert\NotBlank()
     */
    protected $name;

    /**
     * @var \Lyssal\GeographyBundle\Entity\Country The country
     *
     * @ORM\ManyToOne(targetEntity="Country", inversedBy="languages")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    protected $country;

    /**
     * @var string The code
     *
     * @ORM\Column(type="string", nullable=true, length=2)
     */
    protected $code;

    /**
     * @var string The culture
     *
     * @ORM\Column(type="string", nullable=true, length=5)
     */
    protected $culture;


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
     * @return Language
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
     * @return Language
     */
    public function setCountry(Country $country)
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
     * Set code
     *
     * @param string $code
     * @return Language
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
     * Set culture
     *
     * @param string $culture
     * @return Language
     */
    public function setCulture($culture)
    {
        $this->culture = $culture;

        return $this;
    }

    /**
     * Get culture
     *
     * @return string
     */
    public function getCulture()
    {
        return $this->culture;
    }


    /**
     * ToString.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->name;
    }
}
