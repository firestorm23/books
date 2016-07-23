<?php

namespace SiteBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

use SiteBundle\Form\FileType;

class BookAdmin extends AbstractAdmin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('name')
            ->add('datePublished')
            ->add('description')
            ->add('sort')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('_action', null, array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                )
            ))
            ->add('id')
            ->add('name')
            ->add('sort')
            ->add('datePublished')
            ->add('description')
            ->add('categories')
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name')
            ->add('datePublished', 'sonata_type_datetime_picker')
            ->add('file', new FileType(), array('required' => false))
            ->add('description', 'textarea',array('attr' => array(
                'class' => 'tinymce',
                'data-theme' => 'simple',
                'cols' => "150",
                'rows' => "30"
            )))
            ->add('categories', 'sonata_type_model', array('multiple' => true))
            ->add('sort');
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('name')
            ->add('year')
            ->add('datePublished')
            ->add('description')
            ->add('sort')
        ;
    }
}
