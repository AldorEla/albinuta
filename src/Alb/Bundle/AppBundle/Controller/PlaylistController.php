<?php

namespace Alb\Bundle\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DomCrawler\Crawler;

class PlaylistController extends Controller
{
	const PLAYLIST_TYPE_YOUTUBE = 'youtube';
	
	/**
     * Render the Online playlist from Youtube
     */
    public function youtubePlaylistAction($type)
    {
    	if(!$type) {
    		$type 		= PLAYLIST_TYPE_YOUTUBE;
    	}

    	if($type == 'youtube') {
	        $url            = 'https://www.youtube.com/playlist?list=PLL_AvPc4DQ_zIlxqZUvgSSE-y2RJgDK-c'; // Default playlist
	        $playlist_links = $this->getYoutubePlaylist($url);
	        $playlist_title = $this->getYoutubePlaylistTitle($url);
	    }

        return $this->render('AlbAppBundle:playlist:youtube_playlist.html.twig', array(
            'playlist_links'    => $playlist_links,
            'playlist_title'    => $playlist_title
        ));
    }

    /**
     * Get the Online playlist from Youtube
     */
    public function getYoutubePlaylist($url) {
        if(!$url) return false;

        $link       = []; // Default to empty array
        $links      = []; // Default to empty array
        $thumbnails = []; // Default to empty array
        $content    = file_get_contents($url);
        $crawler    = new Crawler($content);
        $table      = $crawler->filterXPath('//table[@class="pl-video-table"]');
  
        $links      = $table->filter('tr')->each(function (Crawler $table, $i) {
            $link['href'] = $table->filterXPath('//td[@class="pl-video-title"]')->each(function (Crawler $table, $i) {
                $return = '//www.youtube.com' . $table->filter('a')->attr('href');
                return $return;
            });
            $link['title'] = $table->filterXPath('//td[@class="pl-video-title"]')->each(function (Crawler $table, $i) {
                $return = $table->filter('a')->text();
                return $return;
            });
            return $link;
        });

        return $links;
    }

    /**
     * Get the Online playlist title from Youtube
     */
    public function getYoutubePlaylistTitle($url) {
        if(!$url) return false;

        $title      = ''; // Default to empty array
        $content    = file_get_contents($url);
        $crawler    = new Crawler($content);
        $title      = $crawler->filterXPath('//h1[@class="pl-header-title"]')->text();
        $title      = trim($title);

        return $title;
    }
}
