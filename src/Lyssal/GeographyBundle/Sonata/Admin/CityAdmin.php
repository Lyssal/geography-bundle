<?php
/**
 * This file is part of the Lyssal geography bundle.
 *
 * @copyright Rémi Leclerc
 * @author Rémi Leclerc
 */
namespace Lyssal\GeographyBundle\Sonata\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

/**
 * The Sonata admin class for City.
 */
class CityAdmin extends Admin
{
    /**
     * {@inheritDoc}
     *
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name')
            ->add('subAdministrativeArea')
        ;
    }

    /**
     * {@inheritDoc}
     *
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name')
            ->add('subAdministrativeArea.name')
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                )
            ))
        ;
    }

    /**
     * {@inheritDoc}
     *
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name')
            ->add('code')
            ->add('subAdministrativeArea')
            ->add('latitude')
            ->add('longitude')
            ->add('description')
            ->add('website')
            ->add('gentile')
        ;
    }

    /**
     * {@inheritDoc}
     *
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('name')
            ->add('code')
            ->add('subAdministrativeArea')
            ->add('latitude')
            ->add('longitude')
            ->add('description')
            ->add('website')
            ->add('gentile')
        ;
    }
}
