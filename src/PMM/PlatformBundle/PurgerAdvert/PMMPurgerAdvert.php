<?php
// src/PMM/PlatformBundle/PMMPurger/PMMPurgerAdvert.php

namespace PMM\PlatformBundle\Purger;

use Doctrine\ORM\EntityManagerInterface;

class PMMPurgerAdvert{

	protected $em;

	public function __construct(EntityManagerInterface $eman){

		$this->em = $eman;
	}

	public function purge($days){

		$advRepo = $this->em->getRepository('PMMPlatformBundle:Advert');
		$advSkillRepo = $this->em->getRepository('PMMPlatformBundle:AdvertSkill');

		$oldAdverts = $advRepo->getOldAdverts($days);

		foreach($oldAdverts as $adv){

			$advSkill = $advSkillRepo->findby(array('advert' => $adv));

			foreach($advSkill as $as){

				$this->em->remove($as);
			}

			$this->em->remove($adv);
		}

		$this->em->flush();

	}
}