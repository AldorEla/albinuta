<?php

namespace Alb\Bundle\AppBundle\Repository;

use Alb\Bundle\AppBundle\Entity\PriceHunter;
use Alb\Bundle\AppBundle\Repository\PriceHunterRepository;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;

class PriceHunterRepository extends EntityRepository
{
	/**
	 * Retrieve all products, paginated
	 */
	public static function findAllProducts($em, $page = 1, $limit = NULL, $filters = []) {
		if(!$em) return false;

		$products 		= [];
		$dql 			= 'SELECT ph.title, ph.price, ph.link, ph.price_min, ph.price_max, ph.date FROM AlbAppBundle:PriceHunter ph';
		if(!empty($filters) && isset($filters['price_filter']) && $filters['price_filter'] == 'good_price') {
			$dql = 'SELECT ph.title, ph.price, ph.link, ph.price_min, ph.price_max, ph.date FROM AlbAppBundle:PriceHunter ph WHERE ph.price <= ph.price_min';
		}
    	$products 		= self::paginate($dql, $page, $limit, $em);

    	return $products;
	}

	public static function paginate($dql, $page = 1, $limit = NULL, $em)
	{
		$query = $em->createQuery($dql);
		if($limit) {
			$query->setFirstResult($limit * ($page - 1)) // Offset
			      ->setMaxResults($limit);
		}

       	$paginator = new Paginator($query, true);

       	return $paginator->getQuery()->getArrayResult();
	}

	/**
	 * Retrieve total products pages number
	 */
	public static function getTotalPriceHunterItems($em, $filters = []) {
		if(!$em) return false;

		$totalItems 	= 0;
		$result 		= [];
		$dql			= 'SELECT ph FROM AlbAppBundle:PriceHunter ph';
		if(!empty($filters) && isset($filters['price_filter']) && $filters['price_filter'] == 'good_price') {
			$dql = 'SELECT ph FROM AlbAppBundle:PriceHunter ph WHERE ph.price <= ph.price_min';
		}
		$result 		= $em->createQuery($dql)->getResult();
    	$totalItems 	= count($result);

    	return $totalItems;
	}

	/**
	 * Full Import, save all products from Price Hunter into our database
	 */
	public static function fullImport($em, $data = []) {
		if(!$em || empty($data)) return false;


		foreach($data as $key => $product) {
			$existing_product = self::getExistingProductByTitle($em, $product->title);
			if(!$existing_product) {
				// Insert new product
				$product_entity = new PriceHunter();
				$product_entity->setTitle($product->title);
				$product_entity->setPrice($product->price);
				$product_entity->setPriceMin($product->price_min);
				$product_entity->setPriceMax($product->price_max);
				$product_entity->setLink($product->link);
				$product_entity->setDate(new \DateTime($product->date));
				$product_entity->setImage($product->image);
				$em->persist($product_entity);
				$em->flush();
			} else {
				// Update existing product
				$product_entity = $em->find('AlbAppBundle:PriceHunter', $existing_product);
				if($product_entity->getTitle() != $product->title) {
					$product_entity->setTitle($product->title);
				}
				if($product_entity->getPrice() != $product->price) {
					$product_entity->setPrice($product->price);
				}
				if($product_entity->getPriceMin() != $product->price_min) {
					$product_entity->setPriceMin($product->price_min);
				}
				if($product_entity->getPriceMax() != $product->price_max) {
					$product_entity->setPriceMax($product->price_max);
				}
				if($product_entity->getLink() != $product->link) {
					$product_entity->setLink($product->link);
				}
				$product_entity->setDate(new \DateTime($product->date));
				$product_entity->setImage($product->image);
				$em->persist($product_entity);
				$em->flush();
			}
		}
	}

	/**
	 * Get Existing Product by Title
	 */
	public function getExistingProductByTitle($em, $title = '') {
		$sql 				= "SELECT ph.id FROM price_hunter as ph WHERE ph.title = :title";
		$params['title'] 	= $title;
		$stmt 				= $em->getConnection()->prepare($sql);
		$stmt->execute($params);
		$result 			= $stmt->fetch();
		if ($result) {
			return $result['id'];
		}
		return false;
	}
}