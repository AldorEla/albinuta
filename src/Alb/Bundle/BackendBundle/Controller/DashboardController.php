<?php

namespace Alb\Bundle\BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DashboardController extends Controller
{
	public function indexAction()
	{
		return $this->render('AlbBackendBundle:Dashboard:index.html.twig');
	}
}
