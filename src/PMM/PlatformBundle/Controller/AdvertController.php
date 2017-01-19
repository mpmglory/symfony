<?php

namespace PMM\PlatformBundle\Controller;

use PMM\PlatformBundle\Entity\Advert;
use PMM\PlatformBundle\Entity\Image;
use PMM\PlatformBundle\Entity\Application;
use PMM\PlatformBundle\Entity\Skill;
use PMM\PlatformBundle\Entity\AdvertSkill;
use PMM\PlatformBundle\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AdvertController extends Controller{

    public function indexAction($page){
			
		if($page < 1){
			throw new NotFoundException("Page " .$page. " inexistante.")
		}
		
		//code avant la methode getAdverts() dans le advertRepository 
		$list = $this->getDoctrine()
			->getManager()
			->getRepository('PMMPlatformBundle:Advert')
			->findAll();
		
		return $this->render('PMMPlatformBundle:Advert:index.html.twig', array(
		'listAdverts' => $list
		));

		/*$nbPerPage = 4;
		
		$list = $this->getDoctrine()
			->getManager()
			->getRepository('PMMPlatformBundle:Advert')
			->getAdverts($page, $nbPerPage);
			
		$nbPage = ceil(count($list)/$nbPerPage);
		
		if($page > $nbPage){
			throw $this->createNotFoundException("Page " .$page. " inexistante.");
		}
		
		return $this->render('PMMPlatformBundle:Advert:index.html.twig', array(
		'listAdverts' => $list,
		'page' => $page,
		'nbPage' => $nbPage,
		));*/
	}
	 
	/*public function viewAction($id){
		
		$em = $this->getDoctrine()->getManager();
		
		$myadvert = $em
			->getRepository('PMMPlatformBundle:Advert')
			->find($id);
		
		if (null === $myadvert){
			throw new NotFoundHttpException("Annonce d'id " .$id. " introuvable.");
		}
		
		$listApply = $em
			->getRepository('PMMPlatformBundle:Application')
			->findBy(array('advert' => $myadvert));
			
		$listAdvSkills = $em
			->getRepository('PMMPlatformBundle:AdvertSkill')
			->findBy(array('advert' => $myadvert));
			
		$allSkills = $em
			->getRepository('PMMPlatformBundle:Skill')
			->findAll();
				
		return $this->render('PMMPlatformBundle:Advert:view.html.twig', array(
			'advert' => $myadvert,
			'listApplications' => $listApply,
			'listAdvSkills' => $listAdvSkills,
		));
	}
	
	public function addAction(Request $request){
		
		$em = $this->getDoctrine()->getManager();
				
		if($request->isMethod('POST')){
			$request->getSession()->getFlashBag()
			->add('notice', 'Annonce bien enregistree.');
			
			return $this->redirectToRoute('pmm_platform_view', array('id' => $advert->getId()));
		}
	
		return $this->render('PMMPlatformBundle:Advert:add.html.twig');
	}
	
	public function editAction($id, Request $request){
		
		$em = $this->getDoctrine()->getManager();
		
		$myadvert = $em->getRepository('PMMPlatformBundle:Advert')->find($id);
		
		if (null === $myadvert){
			throw new NotFoundHttpException("Annonce d'id" .$id. " introuvable.");
		}
		
		if($request->isMethod('POST')){
			
			$request->getSession()->getFlashBag()
				->add('notice', 'Annonce bien modifiee.');
			
			return $this->redirectToRoute('pmm_platform_view', array('id' => $myadvert->getId()));
		}
		
		return $this->render('PMMPlatformBundle:Advert:edit.html.twig', array(
			'advert' => $myadvert
		));
	}
	
	public function deleteAction($id){
		
		$em = $this->getDoctrine()->getManager();
		$advert = $em
			->getRepository('PMMPlatformBundle:Advert')
			->find($id);
			
		if (null === $myadvert){
			throw new NotFoundHttpException("Annonce d'id" .$id. " inexistante.");
		}
			
		foreach($advert->getCategories() as $category){
			$advert->removeCategory($category);
		}
		
		//$em->persist($advert);
		$em->flush();
					
		return $this->render('PMMPlatformBundle:Advert:delete.html.twig'));
	}
	
	public function menuAction($limit){
		
		$em = $this->getDoctrine()->getManager();
		$listAdverts = $em
			->getRepository('PMMPlatformBundle:Advert')
			->findBy(
				array(),
				array('date' => 'desc'),
				$limit,
				0
			);

		return $this->render('PMMPlatformBundle:Advert:menu.html.twig', array(
			'listAdverts' => $listAdverts
		));
	}
*/
}