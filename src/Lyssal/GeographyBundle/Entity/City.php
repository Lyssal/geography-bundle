<?php
/**
 * This file is part of the Lyssal geography bundle.
 *
 * @copyright Rémi Leclerc
 * @author Rémi Leclerc
 */
namespace Lyssal\GeographyBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Lyssal\Geography\Model\City as GeographyCity;

/**
 * {@inheritDoc}
 */
class City extends GeographyCity
{
    /**
     * {@inheritDoc}
     */
    public function __construct()
    {
        parent::__construct();
        $this->postalCodes = new ArrayCollection();
    }
}
