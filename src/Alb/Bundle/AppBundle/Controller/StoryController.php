<?php

namespace Alb\Bundle\AppBundle\Controller;

use Alb\Bundle\AppBundle\Entity\Story;
use Alb\Bundle\AppBundle\Repository\StoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Story controller.
 *
 */
class StoryController extends Controller
{
    const STORIES_LISTING_LIMIT = 9; // 9
    /**
     * Lists all story entities.
     *
     */
    public function indexAction($page, Request $request)
    {
        $doctrine       = $this->getDoctrine();
        $em             = $doctrine->getManager();
        $limit          = SELF::STORIES_LISTING_LIMIT; 
        $stories        = StoryRepository::findAllStories($em, $page, $limit);
        $totalStories   = StoryRepository::getTotalStoryItems($em);

        $currentPage    = $request->get('page');

        return $this->render('AlbAppBundle:story:index.html.twig', array(
            'stories'       => $stories,
            'totalStories'  => $totalStories,
            'currentPage'   => $currentPage,
        ));
    }

    /**
     * Creates a new story entity.
     *
     */
    public function newAction(Request $request)
    {
        $story = new Story();
        $form = $this->createForm('Alb\Bundle\AppBundle\Form\StoryType', $story);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($story);
            $em->flush();

            return $this->redirectToRoute('story_show', array('id' => $story->getId()));
        }

        return $this->render('AlbAppBundle:story:new.html.twig', array(
            'story' => $story,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a story entity.
     *
     */
    public function showAction(Story $story)
    {
        $deleteForm = $this->createDeleteForm($story);

        return $this->render('AlbAppBundle:story:show.html.twig', array(
            'story' => $story,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing story entity.
     *
     */
    public function editAction(Request $request, Story $story)
    {
        $deleteForm = $this->createDeleteForm($story);
        $editForm = $this->createForm('Alb\Bundle\AppBundle\Form\StoryType', $story);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('story_edit', array('id' => $story->getId()));
        }

        return $this->render('AlbAppBundle:story:edit.html.twig', array(
            'story' => $story,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a story entity.
     *
     */
    public function deleteAction(Request $request, Story $story)
    {
        $form = $this->createDeleteForm($story);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($story);
            $em->flush();
        }

        return $this->redirectToRoute('story_index');
    }

    /**
     * Creates a form to delete a story entity.
     *
     * @param Story $story The story entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Story $story)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('story_delete', array('id' => $story->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    public function paginationAction($totalStories, $currentPage) {
        // Get first page
        $first = 1;

        // Get last page
        $last = '';

        // Get previous page
        $previous = '';

        // Get next page
        $next = '';
        
        // Default empty pagination and add the built elements to the pagination array
        $pagination             = [];

        // Get amount of pages
        $limit = SELF::STORIES_LISTING_LIMIT;
        $pages = 1;
        if($totalStories > $limit) {
            $pages = $totalStories / $limit;
            $pages = ceil($pages);
            
            $pagination['first']    = $first;
            $pagination['last']     = $last;
            $pagination['pages']    = $pages;
            $pagination['previous'] = $previous;
            $pagination['next']     = $next;
        }


        return $this->render('AlbAppBundle:story:pagination.html.twig', array(
            'pagination'    => $pagination,
            'currentPage'   => $currentPage
        ));
    }
}
