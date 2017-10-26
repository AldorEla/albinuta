<?php

namespace Alb\Bundle\AppBundle\Controller;

use Alb\Bundle\AppBundle\Entity\PriceHunter;
use Alb\Bundle\AppBundle\Repository\PriceHunterRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

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
        $doctrine       = $this->getDoctrine();
        $em             = $doctrine->getManager();
        $limit          = self::PRODUCTS_LISTING_LIMIT; 

        $products       = PriceHunterRepository::findAllProducts($em, $page, $limit);
        $totalProducts  = PriceHunterRepository::getTotalPriceHunterItems($em);

        $currentPage    = $request->get('page');
        

        return $this->render('AlbAppBundle:pricehunter:index.html.twig', array(
            'products'       => $products,
            'totalProducts'  => $totalProducts,
            'currentPage'    => $currentPage,
        ));
    }

    /**
     * Lists all Products provided by Price Hunter.
     *
     */
    public function goodPriceAction($page, Request $request)
    {
        $doctrine       = $this->getDoctrine();
        $em             = $doctrine->getManager();
        $limit          = self::PRODUCTS_LISTING_LIMIT; 
        
        $filters        = ['price_filter' => 'good_price'];
        $products       = PriceHunterRepository::findAllProducts($em, $page, $limit, $filters);
        $totalProducts  = PriceHunterRepository::getTotalPriceHunterItems($em, $filters);

        $currentPage    = $request->get('page');
        

        return $this->render('AlbAppBundle:pricehunter:index.html.twig', array(
            'products'       => $products,
            'totalProducts'  => $totalProducts,
            'currentPage'    => $currentPage,
        ));
    }

    public function jsonAction() {
    	$return = '';
    	$products = [];
    	$content = file_get_contents(self::PRICE_HUNTER_URL);

    	$products = $this->json_validate($content);
    	if($products)
    		echo json_encode($products, ENT_QUOTES | JSON_UNESCAPED_SLASHES);
    	exit;
    }

    function json_validate($string)
	{
	    // decode the JSON data
	    $result = json_decode($string);

	    // switch and check possible JSON errors
	    switch (json_last_error()) {
	        case JSON_ERROR_NONE:
	            $error = ''; // JSON is valid // No error has occurred
	            break;
	        case JSON_ERROR_DEPTH:
	            $error = 'The maximum stack depth has been exceeded.';
	            break;
	        case JSON_ERROR_STATE_MISMATCH:
	            $error = 'Invalid or malformed JSON.';
	            break;
	        case JSON_ERROR_CTRL_CHAR:
	            $error = 'Control character error, possibly incorrectly encoded.';
	            break;
	        case JSON_ERROR_SYNTAX:
	            $error = 'Syntax error, malformed JSON.';
	            break;
	        // PHP >= 5.3.3
	        case JSON_ERROR_UTF8:
	            $error = 'Malformed UTF-8 characters, possibly incorrectly encoded.';
	            break;
	        // PHP >= 5.5.0
	        case JSON_ERROR_RECURSION:
	            $error = 'One or more recursive references in the value to be encoded.';
	            break;
	        // PHP >= 5.5.0
	        case JSON_ERROR_INF_OR_NAN:
	            $error = 'One or more NAN or INF values in the value to be encoded.';
	            break;
	        case JSON_ERROR_UNSUPPORTED_TYPE:
	            $error = 'A value of a type that cannot be encoded was given.';
	            break;
	        default:
	            $error = 'Unknown JSON error occured.';
	            break;
	    }

	    if ($error !== '') {
	        // throw the Exception or exit // or whatever :)
	        exit($error);
	    }

	    // everything is OK
	    return $result;
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

    public function fullImportAction() {
    	$products = [];
    	$content = file_get_contents(self::PRICE_HUNTER_URL);
    	$imported_products = false;

    	$products = $this->json_validate($content);
    	if($products) {
    		$doctrine       = $this->getDoctrine();
	        $em             = $doctrine->getManager();
	        $import_data 	= $products;
	        PriceHunterRepository::fullImport($em, $import_data);
    		$imported_products = true;
    	}
    	if($imported_products) {
    		echo json_encode('{"response": "All products have benn successfully imported from Price Hunter!"}');
    	} else {
    		echo json_encode('{"response": "Something went wrong, the import has failed!"}');
    	}
    	exit;
    }

    public function searchProductsAction(Request $request) {
        $results = [];
        $keyword = $request->get('keyword');
        
        if(!$keyword) return $this->redirectToRoute('price_hunter_index');
        
        $finder = $this->container->get('fos_elastica.finder.app.price_hunter');
        $results = $finder->find($keyword, 1000);

        return $this->render('AlbAppBundle:pricehunter:search-results.html.twig', array(
            'results'=> $results,
            'keyword' => $keyword
        ));
    }

    public function searchProductsAjaxAction(Request $request) {
        $results = [];
        $data = self::convert_form_array($request->get('data'));
        $keyword = $data['keyword'];
        
        if(!$keyword || $keyword == ':all') {
            $doctrine = $this->getDoctrine();
            $em = $doctrine->getManager();
            $results = PriceHunterRepository::findAllProducts($em, NULL);
        } else {
            $finder = $this->container->get('fos_elastica.finder.app.price_hunter');
            $results = $finder->find($keyword, 1000);
        }

        return $this->render('AlbAppBundle:pricehunter:ajax-search-results.html.twig', array(
            'results'    => $results,
            'keyword' => $keyword
        ));
    }

    public function searchProductsAjaxSuggestionsAction(Request $request) {
        $results = [];
        $data = self::convert_form_array($request->get('data'));
        $keyword = $data['keyword'];
        
        if(!$keyword) {
            echo 'no_result';
            exit;
        }
        $displayLimit = 20;
        $searchLimit = 1000;
        
        $finder = $this->container->get('fos_elastica.finder.app.price_hunter');
        $totalResults = count($finder->find($keyword, $searchLimit));
        $results = $finder->find($keyword, $displayLimit);

        if($displayLimit > $totalResults) {
            $displayLimit = $totalResults;
        }

        return $this->render('AlbAppBundle:pricehunter:ajax-search-results-suggestions.html.twig', array(
            'results'    => $results,
            'keyword' => $keyword,
            'totalResults' => $totalResults,
            'displayLimit' => $displayLimit
        ));
    }

    /**
     * Helper function
     *
     * @param:  array serializedArray - by javascript.serializeArray()
     * @return: array - key => value
     */
    function convert_form_array($serializedArray) {
        $temp = [];
        if (is_array($serializedArray) || is_object($serializedArray)) {
            foreach ($serializedArray as $key => $value) {
                $temp[$value['name']] = $value['value'];
            }
        }
        return $temp;
    }
}
