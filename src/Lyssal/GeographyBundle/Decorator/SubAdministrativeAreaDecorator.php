<?php
/**
 * This file is part of the Lyssal geography bundle.
 *
 * @copyright Rémi Leclerc
 * @author Rémi Leclerc
 */
namespace Lyssal\GeographyBundle\Decorator;

use Lyssal\Entity\Decorator\AbstractDecorator;
use Lyssal\GeographyBundle\Entity\SubAdministrativeArea;

/**
 * The Decorator class for SubAdministrativeArea.
 */
class SubAdministrativeAreaDecorator extends AbstractDecorator
{
    /**
     * {@inheritDoc}
     *
     * @param object $entity The decorator's entity
     */
    public function supports($entity)
    {
        return ($entity instanceof SubAdministrativeArea);
    }
}
