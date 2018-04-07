<?php
/**
 * This file is part of the Lyssal geography bundle.
 *
 * @copyright Rémi Leclerc
 * @author Rémi Leclerc
 */
namespace Lyssal\GeographyBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Lyssal\Geography\Model\Country as GeographyCountry;

/**
 * {@inheritDoc}
 */
class Country extends GeographyCountry
{
    /**
     * {@inheritDoc}
     */
    public function __construct()
    {
        parent::__construct();
        $this->administrativeAreas = new ArrayCollection();
        $this->languages = new ArrayCollection();
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
     * Remove languages
     *
     * @param \Lyssal\GeographyBundle\Entity\Language $language
     */
    public function removeLanguage(\Lyssal\GeographyBundle\Entity\Language $language)
    {
        $this->languages->removeElement($language);
    }
}
