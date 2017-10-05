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
use Lyssal\GeographyBundle\Entity\Country;
use Lyssal\GeographyBundle\Decorator\CountryDecorator;

/**
 * The Appellation class for Country.
 */
class CountryAppellation extends AbstractAppellation
{
    use ToStringTrait;


    /**
     * {@inheritDoc}
     *
     * @param object $object The appellation's object
     */
    public function supports($object)
    {
        return ($object instanceof Country || $object instanceof CountryDecorator);
    }
}
