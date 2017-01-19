<?php

namespace PMM\PlatformBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use PMM\PlatformBundle\Entity\Category;

class LoadCategory implements FixtureInterface
{
    public function load(ObjectManager $manager){
		
		$names = array(
			'Developpement web',
			'Developpement mobile',
			'Graphisme',
			'integration',
			'Reseau'
		);
		
		foreach ($names as $name){
			
			$category = new Category();
			$category->setName($name);
			
			$manager->persist($category);
		}
		
		$manager->flush();
	}
}
