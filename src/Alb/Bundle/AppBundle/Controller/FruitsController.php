<?php

namespace Alb\Bundle\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type;
use Alb\Bundle\AppBundle\Entity\Fruit;
use Alb\Bundle\AppBundle\Form\FruitType;

class FruitsController extends Controller
{
	/**
     * Fruits
     *
     * @Route("/fruits", name="fruits")
     * @Template()
     */
	public function fruitsAction(Request $request)
    {
        return array_merge(
           $this->createFruitsCollection($request, 'noPlugin'),
           $this->createFruitsCollection($request, 'withPlugin')
        );
    }

    protected function createFruitsCollection(Request $request, $name)
    {
        $data = [
            'fruits' => [
                new Fruit("Apple"),
                new Fruit("Banana"),
                new Fruit("Orange")
           ]
        ];

        $form = $this
           ->get('form.factory')
           ->createNamedBuilder($name, Type\FormType::class, $data)
           ->add('fruits', Type\CollectionType::class, [
               'entry_type'   => FruitType::class,
               'label'        => 'List and order your fruits by preference.',
               'allow_add'    => true,
               'allow_delete' => true,
               'prototype'    => true,
               'required'     => false,
               'attr'         => [
                   'class' => "{$name}-collection",
               ],
           ])
           ->add('submit', Type\SubmitType::class)
           ->getForm()
        ;

        $form->handleRequest($request);
        if ($form->isValid()) {
            $data = $form->getData();
        }

        return [
            $name         => $form->createView(),
            "{$name}Data" => $data,
        ];
    }
}