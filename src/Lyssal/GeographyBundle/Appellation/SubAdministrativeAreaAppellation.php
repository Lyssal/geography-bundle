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
use Lyssal\GeographyBundle\Entity\SubAdministrativeArea;
use Lyssal\GeographyBundle\Decorator\SubAdministrativeAreaDecorator;

/**
 * The Appellation class for SubAdministrativeArea.
 */
class SubAdministrativeAreaAppellation extends AbstractAppellation
{
    use ToStringTrait;


    /**
     * {@inheritDoc}
     *
     * @param object $object The appellation's object
     */
    public function supports($object)
    {
        return ($object instanceof SubAdministrativeArea || $object instanceof SubAdministrativeAreaDecorator);
    }
}
