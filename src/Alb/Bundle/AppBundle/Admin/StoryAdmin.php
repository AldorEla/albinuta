<?php

namespace Alb\Bundle\AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Symfony\Component\HttpFoundation\Request;
use Alb\Bundle\AppBundle\Repository\StoryRepository;
use Symfony\Component\DependencyInjection\ContainerInterface;

class StoryAdmin extends AbstractAdmin
{
	protected $baseRoutePattern = 'story';

    protected function configureFormFields(FormMapper $formMapper)
	{   
        $container = $this->getConfigurationPool()->getContainer();
        $story_upload_destination = $container->getParameter('story_upload_destination');
        $story_image_name = $this->getSubject()->getImage();
        $story_image_url = $story_upload_destination . $story_image_name;

	    $formMapper
	    	 ->with('Content', ['class' => 'col-md-9'])
                ->add('title', 'text')
	            ->add('content', 'textarea', [
                    'attr' => [
                        'class' => 'tinymce',
                     ]
                ])
	        ->end()
            ->with('Media', ['class' => 'col-md-3'])
                ->add('video', 'text', [
                     'sonata_help' => '<a href="' .  $this->getSubject()->getVideo(). '" class="colorbox-video">Watch video</a><script src="/bundles/albfrontend/third-party/colorbox/jquery.colorbox-min.js"></script>
                        <script type="text/javascript">$(document).ready(function() { $(\'.colorbox-video\').colorbox({iframe: true, inline: true, width: "80%", height: "80%"; opacity: "0.85"}); } );</script>
                        <link rel="stylesheet" type="text/css" href="/bundles/albfrontend/third-party/colorbox/colorbox.css">',
                ])
                ->add('image', NULL, [
                    'attr' => ['readonly' => 'true'],
                    'sonata_help' => '<a href="' . $story_image_url . '" class="colorbox"><img src="' . $story_image_url . '" width="100%" /></a>
                        <script type="text/javascript">$(document).ready(function() { $(\'.colorbox\').colorbox({width: "80%", height: "80%", opacity: "0.85"}); } );</script>',
                    'required' => FALSE,
                ])
                ->add('imageFile', VichFileType::class, [
                    'label' => false,
                    'required' => FALSE,
                    'attr' => ['class' => 'text-center'],
                ])
            ->end()
	    ;
	}

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('title')
            ->add('image', NULL, [
                'template' => 'SonataAdminBundle:CRUD:image.html.twig',
            ])
        ;
    }

    public function toString($object)
    {
        return $object 
            ? $object->getTitle()
            : 'Story'; // shown in the breadcrumb on the create view
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('title');
    }
}
