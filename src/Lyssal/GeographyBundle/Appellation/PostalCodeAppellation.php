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
use Lyssal\GeographyBundle\Entity\PostalCode;
use Lyssal\GeographyBundle\Decorator\PostalCodeDecorator;

/**
 * The Appellation class for PostalCode.
 */
class PostalCodeAppellation extends AbstractAppellation
{
    use ToStringTrait;


    /**
     * {@inheritDoc}
     *
     * @param object $object The appellation's object
     */
    public function supports($object)
    {
        return ($object instanceof PostalCode || $object instanceof PostalCodeDecorator);
    }
}
