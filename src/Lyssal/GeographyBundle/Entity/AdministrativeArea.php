<?php
/**
 * This file is part of the Lyssal geography bundle.
 *
 * @copyright Rémi Leclerc
 * @author Rémi Leclerc
 */
namespace Lyssal\GeographyBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Lyssal\Geography\Model\AdministrativeArea as GeographyAdministrativeArea;

/**
 * {@inheritDoc}
 */
class AdministrativeArea extends GeographyAdministrativeArea
{
    /**
     * {@inheritDoc}
     */
    public function __construct()
    {
        parent::__construct();
        $this->subAdministrativeAreas = new ArrayCollection();
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
}
