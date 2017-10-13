<?php

namespace Alb\Bundle\BackendBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;

class BlogPostAdmin extends AbstractAdmin
{
	protected $baseRoutePattern = 'blog_post';

    protected function configureFormFields(FormMapper $formMapper)
	{
	    $formMapper
	    	 ->with('Content', ['class' => 'col-md-9'])
	            ->add('title', 'text')
	            ->add('body', 'textarea', [
                    'attr' => [
                        'class' => 'tinymce',
                     ]
                ])
	        ->end()
	        ->with('Meta data', ['class' => 'col-md-3'])
	            ->add('category', 'sonata_type_model', [
	                'class' => 'Alb\Bundle\BackendBundle\Entity\Category',
	                'property' => 'name',
	                'attr' => ['data-sonata-select2-allow-clear' => 'false'],
	            ])
	            ->add('draft', 'checkbox', [
	            	'attr' => [
	            		'class' => ''
	            	]
	        	])
	        ->end()
	    ;
	}

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('title')
            ->add('category.name')
            ->add('draft')
        ;
    }

    public function toString($object)
    {
        return $object 
            ? $object->getTitle()
            : 'Blog Post'; // shown in the breadcrumb on the create view
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('title');
    }
}
