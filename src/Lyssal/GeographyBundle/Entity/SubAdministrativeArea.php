<?php
/**
 * This file is part of the Lyssal geography bundle.
 *
 * @copyright Rémi Leclerc
 * @author Rémi Leclerc
 */
namespace Lyssal\GeographyBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Lyssal\Geography\Model\SubAdministrativeArea as GeographySubAdministrativeArea;

/**
 * {@inheritDoc}
 */
class SubAdministrativeArea extends GeographySubAdministrativeArea
{
    /**
     * {@inheritDoc}
     */
    public function __construct()
    {
        parent::__construct();
        $this->cities = new ArrayCollection();
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
}
