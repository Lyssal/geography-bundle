<?php
/**
 * This file is part of the Lyssal geography bundle.
 *
 * @copyright Rémi Leclerc
 * @author Rémi Leclerc
 */
namespace Lyssal\GeographyBundle\Appellation;

use Lyssal\Entity\Appellation\AbstractAppellation;
use Lyssal\Entity\Appellation\Traits\ToStringTrait;
use Lyssal\GeographyBundle\Entity\City;
use Lyssal\GeographyBundle\Decorator\CityDecorator;

/**
 * The Appellation class for City.
 */
class CityAppellation extends AbstractAppellation
{
    use ToStringTrait;


    /**
     * {@inheritDoc}
     *
     * @param object $object The appellation's object
     */
    public function supports($object)
    {
        return ($object instanceof City || $object instanceof CityDecorator);
    }
}
