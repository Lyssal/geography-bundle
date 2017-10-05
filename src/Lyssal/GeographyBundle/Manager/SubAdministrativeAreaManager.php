<?php
/**
 * This file is part of the Lyssal geography bundle.
 *
 * @copyright Rémi Leclerc
 * @author Rémi Leclerc
 */
namespace Lyssal\GeographyBundle\Manager;

use Lyssal\Doctrine\Orm\Manager\EntityManager;
use Lyssal\GeographyBundle\Entity\Country;

/**
 * The manager of SubAdministrativeArea.
 */
class SubAdministrativeAreaManager extends EntityManager
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

        return $this->findBy(array(), $orderBy);
    }


    /**
     * Get the sub administrative areas of a country.
     *
     * @param \Lyssal\GeographyBundle\Entity\Country $country The country
     * @return \Doctrine\Common\Collections\ArrayCollection The sub administrative areas of the country
     */
    public function findByCountry(Country $country)
    {
        return $this->getRepository()->findByCountry($country);
    }
}
