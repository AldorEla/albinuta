<?php

namespace Alb\Bundle\FrontendBundle\Controller;

use Alb\Bundle\AppBundle\Entity\Story;
use Alb\Bundle\AppBundle\Repository\StoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\DomCrawler\Crawler;
use Phpml\Classification\KNearestNeighbors;

class HomeController extends Controller
{
    public function indexAction(Request $request)
    {
        // $API_KEY = 'AIzaSyBCvwVQ0eela9lIX0Wx46EelodWcYMBtXQ';
        // $CS = '007745925954021933777%3Ackvjqw6v5d0';
        // $query = 'elenaalexie';
        // $url = 'https://www.googleapis.com/customsearch/v1?q=www.linkedin.com%2Fin%2'.$query.'&cs='.$CS.'$key=' . $API_KEY;
        // $curl_handle=curl_init();
        // curl_setopt($curl_handle, CURLOPT_URL,'http://###.##.##.##/mp/get?mpsrc=http://mybucket.s3.amazonaws.com/11111.mpg&mpaction=convert format=flv');
        // curl_setopt($curl_handle, CURLOPT_URL,$url);
        // curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
        // curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        // curl_setopt($curl_handle, CURLOPT_USERAGENT, 'Your application name');
        // $query = curl_exec($curl_handle);
        // curl_close($curl_handle);

        // dump($query);
        // exit;




        // $samples = [[1, 3], [1, 4], [2, 4], [3, 1], [4, 1], [4, 2]];
        // $labels = ['a', 'a', 'a', 'b', 'b', 'b'];

        // $classifier = new KNearestNeighbors();
        // $classifier->train($samples, $labels);

        // dump($classifier->predict([3, 2]));
        // exit;
//         $text = '


//  


//  



// Vevőszolgálati szerelő

// Feladatok:


// 	A vállalat termelő berendezéseinek karbantartása, felújítása
// 	Fejlesztési projektekben való aktív részvétel
// 	Vevői reklamációk kivizsgálása
// 	Vevők látogatása, műszaki támogatása


// Elvárások:


// 	Műszaki végzettség, beállítottság
// 	Jó kommunikációs készség, kreativitás, rugalmasság
// 	Önálló munkavégzésre való képesség
// 	Számítógépes ismeretek, B kategóriás jogosítvány


// Munkavégzés &nbsp; &nbsp; &nbsp;helye:


// 	Pest                    megye









// ';

// $patterns_step_1 = ["@\n+@", "@\t+@", "@\t\n+@", "@\r\n+@", "@( |&nbsp;)+@"];
// $replacements_step_1 = ["\n", "", "\n", "\n", " "];
// $text = preg_replace($patterns_step_1, $replacements_step_1, $text);
// $text = trim($text,"\n".chr(0xC2).chr(0xA0));
// echo nl2br($text);

// dump($text);
// dump($text);
// exit;

        $doctrine       = $this->getDoctrine();
    	$em 			= $doctrine->getManager();
        $stories 		= StoryRepository::findAllStories($em, 1, 3);

        // Randomize the stories
        shuffle($stories);

        return $this->render('AlbFrontendBundle:Home:index.html.twig', array(
            'stories' 			=> $stories
        ));
    }
}
