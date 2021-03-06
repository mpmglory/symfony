<?php

namespace PMM\PlatformBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * ApplicationRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ApplicationRepository extends \Doctrine\ORM\EntityRepository
{
	public function getApplicationsWithAdvert($limit){
		
		$qb = $this->createQueryBuilder('a');
		$qb
			->innerJoin('a.advert', 'adv')
			->andSelect('adv');
		
		$qb->setMaxResults($limit);
		
		return $qb->getQuery()->getResult();
	}
}
