<?php
/**
 * This file is part of the Lyssal geography bundle.
 *
 * @copyright Rémi Leclerc
 * @author Rémi Leclerc
 */
namespace Lyssal\GeographyBundle\Manager;

use Lyssal\Doctrine\Orm\Manager\EntityManager;

/**
 * The manager of Country.
 */
class CountryManager extends EntityManager
{
    /**
     * {@inheritDoc}
     *
     * @param array $orderBy The order of the results
     */
    public function findAll(array $orderBy = null)
    {
        if (null === $orderBy) {
            $orderBy = array('name' => 'ASC');
        }

        return $this->getRepository()->findBy(array(), $orderBy);
    }
}
