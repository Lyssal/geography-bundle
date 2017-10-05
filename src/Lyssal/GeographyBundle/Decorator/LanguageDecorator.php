<?php
/**
 * This file is part of the Lyssal geography bundle.
 *
 * @copyright Rémi Leclerc
 * @author Rémi Leclerc
 */
namespace Lyssal\GeographyBundle\Decorator;

use Lyssal\Entity\Decorator\AbstractDecorator;
use Lyssal\GeographyBundle\Entity\Language;

/**
 * The Decorator class for Language.
 */
class LanguageDecorator extends AbstractDecorator
{
    /**
     * {@inheritDoc}
     *
     * @param object $entity The decorator's entity
     */
    public function supports($entity)
    {
        return ($entity instanceof Language);
    }
}
