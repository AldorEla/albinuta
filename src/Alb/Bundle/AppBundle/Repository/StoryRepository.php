<?php

namespace Alb\Bundle\AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;

class StoryRepository extends EntityRepository
{
	/**
	 * Retrieve all stories, paginated
	 */
	public static function findAllStories($em, $page = 1, $limit = 2) {
		if(!$em) return false;

		$stories 		= [];
		$dql 			= 'SELECT s.id, s.title, s.video, s.content FROM AlbAppBundle:Story s';
    	$stories 		= self::paginate($dql, $page, $limit, $em);

    	return $stories;
	}

	public static function paginate($dql, $page = 1, $limit = 10, $em)
	{
		$query = $em->createQuery($dql)
					->setFirstResult($limit * ($page - 1)) // Offset
					->setMaxResults($limit);

       	$paginator = new Paginator($query, true);

       	return $paginator->getQuery()->getArrayResult();
	}

	/**
	 * Retrieve total story pages number
	 */
	public static function getTotalStoryItems($em) {
		if(!$em) return false;

		$totalItems 	= 0;
		$result 		= [];
		$dql			= 'SELECT s.id, s.title, s.video, s.content FROM AlbAppBundle:Story s';
		$result 		= $em->createQuery($dql)->getResult();
    	$totalItems 	= count($result);

    	return $totalItems;
	}
}