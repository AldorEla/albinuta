<?php

namespace Alb\Bundle\BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AlbBackendBundle:Default:index.html.twig');
    }
}
