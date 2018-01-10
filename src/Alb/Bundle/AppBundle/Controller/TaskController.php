<?php

namespace Alb\Bundle\AppBundle\Controller;

use Alb\Bundle\AppBundle\Entity\Task;
use Alb\Bundle\AppBundle\Form\TaskType;
use Alb\Bundle\AppBundle\Entity\Tag;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class TaskController extends Controller
{
    public function newAction(Request $request)
    {
        $doctrine       = $this->getDoctrine();
        $em             = $doctrine->getManager();
        $task = new Task();

        $tag1 = new Tag();
        $tag1->setName('tag1');
        $task->getTags()->add($tag1);
        $tag2 = new Tag();
        $tag2->setName('tag2');
        $task->getTags()->add($tag2);

        $form = $this->createForm(TaskType::class, $task);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $task->setDescription($form->getData()->getDescription());

            $submitted_tags = $form->getData()->getTags();
            foreach ($submitted_tags as $submitted_tag) {
                $tag = new Tag();
                $tag->setName($submitted_tag->getName());
                $em->persist($tag);
                $task->getTags()->add($tag);
            }
            
            $em->persist($task);
            $em->flush();
        }

        return $this->render('AlbAppBundle:task:new.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}