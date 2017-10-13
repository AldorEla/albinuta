<?php

namespace Alb\Bundle\BackendBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;

class CategoryAdmin extends AbstractAdmin
{
    protected $baseRoutePattern = 'category';

    public function configureBatchActions($actions)
    {
        // if (
        //   $this->hasRoute('edit') && $this->hasAccess('edit') &&
        //   $this->hasRoute('delete') && $this->hasAccess('delete')
        // ) {
        //     $actions['merge'] = array(
        //         'ask_confirmation' => true
        //     );

        // }

        return $actions;
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('name', 'text');
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('name');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('name');
    }

    public function toString($object)
    {
        return $object 
            ? $object->getName()
            : 'Category'; // shown in the breadcrumb on the create view
    }
}