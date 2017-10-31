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
        $story_image_url = '';

        if($story_image_name) {
            $story_image_url = $story_upload_destination . $story_image_name;
        }

	    $formMapper
	    	 ->with('Content', ['class' => 'col-md-9'])
                ->add('title', 'text', ['attr' => ['placeholder' => 'Enter the title of the story']])
	            ->add('content', 'textarea', [
                    'attr' => [
                        'class' => 'tinymce',
                     ]
                ])
            ->end()
            ->with('Filters', ['class' => 'col-md-3'])
                ->add('language', 'text', ['required' => false, 'label' => 'Video language', 'attr' => ['placeholder' => 'Enter English language name']])
                ->add('type', 'text', ['required' => false, 'label' => 'Video type', 'attr' => ['placeholder' => 'Enter the video type']])
                ->add('genre', 'text', ['required' => false, 'label' => 'Video genre', 'attr' => ['placeholder' => 'Enter the video genre']])
                ->add('recommended_age', 'text', ['required' => false, 'attr' => ['placeholder' => 'Enter the recommended age']])
            ->end()
            ->with('Media', ['class' => 'col-md-3'])
                ->add('video', 'text', [
                    'required' => false, 
                    'attr' => ['placeholder' => 'Enter an embedable video url'],
                    'sonata_help' => $this->getSubject()->getVideo() ? '<a href="' .  $this->getSubject()->getVideo(). '" class="colorbox-video">Watch video</a><script src="/bundles/albfrontend/third-party/colorbox/jquery.colorbox-min.js"></script>
                        <script type="text/javascript">$(document).ready(function() { $(\'.colorbox-video\').colorbox({iframe: true, inline: true, width: "80%", height: "80%"; opacity: "0.85"}); } );</script>
                        <link rel="stylesheet" type="text/css" href="/bundles/albfrontend/third-party/colorbox/colorbox.css">' : '',
                ])
                ->add('image', null, [
                    'attr' => ['readonly' => 'true', 'placeholder' => 'Upload image file'],
                    'sonata_help' => $story_image_url ? '<a href="' . $story_image_url . '" class="colorbox"><img src="' . $story_image_url . '" width="100%" /></a>
                        <script type="text/javascript">$(document).ready(function() { $(\'.colorbox\').colorbox({width: "80%", height: "80%", opacity: "0.85"}); });</script>' : '',
                    'required' => false,
                ])
                ->add('imageFile', VichFileType::class, [
                    'label' => false,
                    'required' => false,
                    'attr' => ['class' => 'text-center'],
                ])
            ->end()
	    ;
	}

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('title')
            ->add('image', null, [
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
