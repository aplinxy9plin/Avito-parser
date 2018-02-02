<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\HttpFoundation\Response;

class AvitoController
{
    /**
     * @Route("/avito")
     */
    public function avito()
    {
    	function parseB($url){
    	$html = file_get_contents($url);
        $crawler = new Crawler();
        $crawler->addHTMLContent($html);
        $rows = array();
        $tr_elements = $crawler->filterXPath('//div[@class="item item_table clearfix js-catalog-item-enum
    c-b-0   "]');
        foreach ($tr_elements as $i => $content) {
            $tds = array();
            $crawler = new Crawler($content);
            foreach ($crawler->filter('h3 > a') as $i => $node) {
                $tds[] = $node->nodeValue;
            }
            $rows['title'][] = $tds;
    
            $urlProduct = $crawler->filterXPath('//h3[@class="title item-description-title"]/a[@class="item-description-title-link"]')->attr('href');
            $rows['url'][] = 'https://avito.ru'.$urlProduct.'';

            $date = $crawler->filterXPath('//div[@class="date c-2"]')->text();
            $rows['date'][] = $date;

            $tds = array();
            foreach ($crawler->filter('div > div[class="about"]') as $i => $node) {
                $tds[] = $node->nodeValue;
            }
            $rows['price'][] = $tds;
        }
        return $rows;
    }
    // Получить айди продавца - отдельная функция!!! на странице с таблицей
    function get_user_id($url){
        //echo $url;
        sleep(2);
        $html = file_get_contents($url);
        $crawler = new Crawler();
        $crawler->addHTMLContent($html);
        $user_id = array();
        $link_id = $crawler->filterXPath('//div[@class="seller-info-name"]/a')->attr('href');
        $user_id = str_replace('/', '', preg_replace('/(.*)user(.*)profile(.*)/sm', '\2', $link_id));
        return $user_id;
    }
    //$rows[1] = parseB('https://www.avito.ru/tomsk');
    for ($j=2; $j < 4; $j++) { 
    	//sleep(1);
    	$rows[$j] = parseB('https://www.avito.ru/tomsk?p='.$j.'&s=101');
        for ($i=0; $i < 39; $i++) {
            //$rows['user_id'] = get_user_id($rows[$j]['url'][$i]);
            echo($i);echo($rows[$j]['title'][$i][0]);echo($rows[$j]['price'][$i][0]);echo($rows[$j]['url'][$i]);echo($rows[$j]['date'][$i]);echo('<br>');
        }
    }
    return new Response();
    //var_dump($rows[0]);
    }
}