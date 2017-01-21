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
			throw new NotFoundException("Page " .$page. " inexistante.");
		}
	

		$nbPerPage = 3;
		
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
		));
	}
	 
	public function viewAction($id){
		
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
			'listAdvertSkills' => $listAdvSkills,
		));
	}
	
	public function addAction(Request $request){
		
		$em = $this->getDoctrine()->getManager();
		//***********
/*
    // Création de l'entité
    $advert = new Advert();
    $advert->setTitle('Recherche développeur Symfony.');
    $advert->setAuthor('Alexandre');
    $advert->setContent("Nous recherchons un développeur Symfony débutant sur Lyon. Blabla…");
    // Création de l'entité Image
    $image = new Image();
    $image->setUrl('http://sdz-upload.s3.amazonaws.com/prod/upload/job-de-reve.jpg');
    $image->setAlt('Job de rêve');
    // On lie l'image à l'annonce
    $advert->setImage($image);
    // Création d'une première candidature
    $application1 = new Application();
    $application1->setAuthor('Marine');
    $application1->setContent("J'ai toutes les qualités requises.");
    // Création d'une deuxième candidature par exemple
    $application2 = new Application();
    $application2->setAuthor('Pierre');
    $application2->setContent("Je suis très motivé.");
    // On lie les candidatures à l'annonce
    $application1->setAdvert($advert);
    $application2->setAdvert($advert);
    // On récupère toutes les compétences possibles
    $listSkills = $em->getRepository('PMMPlatformBundle:Skill')->findAll();
    // Pour chaque compétence
    foreach ($listSkills as $skill) {
      // On crée une nouvelle « relation entre 1 annonce et 1 compétence »
      $advertSkill = new AdvertSkill();
      // On la lie à l'annonce, qui est ici toujours la même
      $advertSkill->setAdvert($advert);
      // On la lie à la compétence, qui change ici dans la boucle foreach
      $advertSkill->setSkill($skill);
      // Arbitrairement, on dit que chaque compétence est requise au niveau 'Expert'
      $advertSkill->setLevel('Expert');
      // Et bien sûr, on persiste cette entité de relation, propriétaire des deux autres relations
      $em->persist($advertSkill);
    }
    // Étape 1 : On « persiste » l'entité
    $em->persist($advert);
    // Étape 1 bis : si on n'avait pas défini le cascade={"persist"},
    // on devrait persister à la main l'entité $image
    // $em->persist($image);
    // Étape 1 ter : pour cette relation pas de cascade lorsqu'on persiste Advert, car la relation est
    // définie dans l'entité Application et non Advert. On doit donc tout persister à la main ici.
    $em->persist($application1);
    $em->persist($application2);
    // Étape 2 : On « flush » tout ce qui a été persisté avant
    $em->flush();*/
		//****************		
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

		$myadvert->setAuthor("MM PLATA");
		$em->persist($myadvert);
		$em->flush();
		
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
					
		return $this->render('PMMPlatformBundle:Advert:delete.html.twig');
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

	public function purgeAction($days){
	
		$pg = $this->container->get('pmm_platform.purger.advert');
		$pg->purge($days);

		return $this->redirectToRoute('pmm_platform_home');
	}

}