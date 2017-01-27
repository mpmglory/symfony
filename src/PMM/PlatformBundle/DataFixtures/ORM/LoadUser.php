<?php

namespace PMM\PlatformBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use PMM\PlatformBundle\Entity\User;

class LoadUser implements FixtureInterface
{
    public function load(ObjectManager $manager){
		
		$listNames = array(
			'plata',
			'bree',
			'magloire',
			'metsar',
		);
		
		foreach ($listNames as $name){
			
			$user = new User();
			$user->setUsername($name);
			$user->setPassword($name);
			$user->setSalt('');
			$user->setRoles(array('ROLE_USER'));
			
			$manager->persist($user);
		}
		
		$manager->flush();
	}
}
