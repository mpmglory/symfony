<?php

namespace PMM\PlatformBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * AdvertRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class AdvertRepository extends \Doctrine\ORM\EntityRepository
{
	public function getAdverts($page, $nbPerPage){
		
		$qb = $this->createQueryBuilder('a')
			->innerJoin('a.image', 'i')
			->addSelect('i')
			->innerJoin('a.categories', 'c')
			->addSelect('c')
			->orderBy('a.date', 'desc')
			->getQuery();
		
		$qb->setFirstResult(($page-1)*$nbPerPage)
			->setMaxResults($nbPerPage);
		
		return new Paginator($qb, true);
	}

	/*public function getOldAdverts($oldOf){
		
		$qb = $this->createQueryBuilder('a')
		  ->where('a.updateAt < ')
		  ->getQuery();
		  $results = $qb->getResult();

		  return $results;

  	}*/
	
	public function myFindAll(){
    
		$queryBuilder = $this->createQueryBuilder('a');

		$query = $queryBuilder->getQuery();

		$results = $query->getResult();

		return $results;
	}

	public function myFind(){
	  
		$qb = $this->createQueryBuilder('a');

		$qb
		  ->where('a.author = :author')
		  ->setParameter('author', 'Plata');

		$this->whereCurrentYear($qb);

		$qb->orderBy('a.date', 'DESC');

		return $qb
		  ->getQuery()
		  ->getResult();
	}

	public function getAdvertWithCategories(array $categoryNames){
	  
		$qb = $this->createQueryBuilder('a');

		$qb
		  ->innerJoin('a.categories', 'c')
		  ->addSelect('c');

		$qb->where($qb->expr()->in('c.name', $categoryNames));

		return $qb
		  ->getQuery()
		  ->getResult();
	}

	protected function whereCurrentYear(QueryBuilder $qb){
		
		$qb
		  ->andWhere('a.date BETWEEN :start AND :end')
		  ->setParameter('start', new \Datetime(date('Y') . '-01-01'))
		  ->setParameter('end', new \Datetime(date('Y') . '-12-31'));
  	}

}
