<?php

namespace Alb\Bundle\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PriceHunterController extends Controller
{
	const PRICE_HUNTER_URL = 'https://www.sandorkovacs.ro/products.json';
	const PRODUCTS_LISTING_LIMIT = 9;

	/**
     * Lists all Products provided by Price Hunter.
     *
     */
    public function indexAction($page, Request $request)
    {
    	// Sample of conent from the json document
		// "title": "Telefon mobil BlackBerry KEYone, Qwerty, 64GB, 4G, Black Edition",
		// "price": 2999.99,
		// "link": "https://www.emag.ro/telefon-mobil-blackberry-keyone-qwerty-64gb-4g-black-edition-keyone-black/pd/D9BZCNBBM/",
		// "date": "14.10.2017",
		// "image": "",
		// "price_min": 2999.99,
		// "price_max": 2999.99

		$json_content = file_get_contents(self::PRICE_HUNTER_URL);
		$products = json_decode($json_content);
		$totalProducts = count($products);
		$currentPage    = $request->get('page');
        

        return $this->render('AlbAppBundle:pricehunter:index.html.twig', array(
            'products'       => $products,
            'totalProducts'  => $totalProducts,
            'currentPage'    => $currentPage,
        ));
    }

    public function jsonAction() {
    	$data = '';
    	$content = file_get_contents(self::PRICE_HUNTER_URL);
    	$data = '{"data": ' . $content . '}';
    	
    	echo htmlspecialchars(json_encode($data), ENT_QUOTES | JSON_UNESCAPED_SLASHES, 'UTF-8');
    	exit;
    }

    public function paginationAction($totalProducts, $currentPage) {
        // Get first page
        $first = 1;

        // Get last page
        $last = '';

        // Get previous page
        $previous = '';

        // Get next page
        $next = '';
        
        // Default empty pagination and add the built elements to the pagination array
        $pagination             = [];

        // Get amount of pages
        $limit = self::PRODUCTS_LISTING_LIMIT;
        $pages = 1;
        if($totalProducts > $limit) {
            $pages = $totalProducts / $limit;
            $pages = ceil($pages);
            
            $pagination['first']    = $first;
            $pagination['last']     = $last;
            $pagination['pages']    = $pages;
            $pagination['previous'] = $previous;
            $pagination['next']     = $next;
        }


        return $this->render('AlbAppBundle:pricehunter:pagination.html.twig', array(
            'pagination'    => $pagination,
            'currentPage'   => $currentPage
        ));
    }
}
