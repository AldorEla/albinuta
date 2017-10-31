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
        $builder->add('title', NULL,  ['attr' => ['placeholder' => 'Enter the title of the story']])
                ->add('video', TextType::class, ['required' => false, 'attr' => ['placeholder' => 'Enter an embedable video url']])
                ->add( "content")
                ->add('language', TextType::class, ['required' => false, 'label' => 'Video language', 'attr' => ['placeholder' => 'Enter English language name']])
                ->add('type', TextType::class, ['required' => false, 'label' => 'Video type', 'attr' => ['placeholder' => 'Enter the video type']])
                ->add('genre', TextType::class, ['required' => false, 'label' => 'Video genre', 'attr' => ['placeholder' => 'Enter the video genre']])
                ->add('recommended_age', TextType::class, ['required' => false, 'attr' => ['placeholder' => 'Enter the recommended age']])
                ->add('image', TextType::class, ['required' => false, 'label' => 'Image', 'attr' => ['readonly' => true, 'placeholder' => 'Click the Browse button to upload']])
                ->add('imageFile', VichFileType::class, ['required' => false, 'label' => 'Image']
        );
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
