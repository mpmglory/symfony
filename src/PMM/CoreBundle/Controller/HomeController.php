<?php

namespace PMM\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class HomeController extends Controller{

    public function indexAction(){
		
		return $this->render('PMMCoreBundle:Home:index.html.twig');
	}
	
	public function contactAction(Request $myrequest){
		
		$session = $myrequest->getSession();
		$session->getFlashBag()->add('info', 
		'Page de contact pas encore disponible.
		Merci de reessayer plus tard.');

		return $this->redirectToRoute('pmm_home');
	}
	
}