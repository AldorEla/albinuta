<?php

namespace Alb\Bundle\AppBundle\Form;

use Alb\Bundle\AppBundle\Entity\Story;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Vich\UploaderBundle\Form\Type\VichFileType;

class StoryType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // $builder->add('title')->add('video', TextType::class, ['required' => false])->add( "content")->add('image', FileType::class, ['required' => false]);
        $builder->add('title')->add('video', TextType::class, ['required' => false])->add( "content")->add('imageFile', VichFileType::class, ['required' => false, 'label' => 'Image']);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Story::class
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'alb_bundle_appbundle_story';
    }
}
