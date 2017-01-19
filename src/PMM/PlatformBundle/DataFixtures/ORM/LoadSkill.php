<?php

namespace PMM\PlatformBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use PMM\PlatformBundle\Entity\Skill;

class LoadCategory implements FixtureInterface
{
    public function load(ObjectManager $manager){
		
		$names = array(
			'PHP',
			'Symfony',
			'Photoshop',
			'Blender',
			'Cisco',
			'Bloc-note'
		);
		
		foreach ($names as $name){
			$skill = new Skill();
			$skill->setName($name);
			
			$manager->persist($skill);
		}
		
		$manager->flush();
	}
}
