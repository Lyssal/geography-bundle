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
 * Code postal d'une city.
 *
 * @author Rémi Leclerc
 * @ORM\MappedSuperclass()
 */
abstract class PostalCode
{
    /**
     * @var integer The ID
     *
     * @ORM\Column(type="integer", nullable=false, options={"unsigned":true})
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var \Doctrine\Common\Collections\Collection The cities
     *
     * @ORM\ManyToMany(targetEntity="City", inversedBy="codePostaux", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    protected $cities;

    /**
     * @var string The code
     *
     * @ORM\Column(type="string", nullable=false, length=5)
     * @Assert\NotBlank()
     */
    protected $code;

    /**
     * @var string The description
     *
     * @ORM\Column(type="string", nullable=true, length=255)
     */
    protected $description;


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
     * Set code
     *
     * @param string $code
     * @return \Lyssal\GeographyBundle\Entity\PostalCode
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
     * Set description
     *
     * @param string $description
     * @return \Lyssal\GeographyBundle\Entity\PostalCode
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
     * ToString.
     *
     * @return string Code postal
     */
    public function __toString()
    {
        return $this->code;
    }
}
