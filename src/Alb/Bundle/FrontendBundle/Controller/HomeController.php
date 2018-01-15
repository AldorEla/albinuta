<?php

namespace Alb\Bundle\FrontendBundle\Controller;

use Alb\Bundle\AppBundle\Entity\Story;
use Alb\Bundle\AppBundle\Repository\StoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\DomCrawler\Crawler;
use Phpml\Classification\KNearestNeighbors;

class HomeController extends Controller
{
    public function indexAction(Request $request)
    {
        $doctrine       = $this->getDoctrine();
    	$em 			= $doctrine->getManager();
        $stories 		= StoryRepository::findAllStoriesSanitized($em, 1, 3);

        // Randomize the stories
        shuffle($stories);

        return $this->render('AlbFrontendBundle:Home:index.html.twig', array(
            'stories' 			=> $stories
        ));
    }
}
