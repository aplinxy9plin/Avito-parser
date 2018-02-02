<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\HttpFoundation\Response;

class TestController
{
    /**
     * @Route("/avito/test")
     */
    public function test()
    {  
        /*
        $url = 'https://avito.ru/tomsk/odezhda_obuv_aksessuary/sapogi_basconi_naturalnaya_kozhazima_1064697874';
        $html = file_get_contents($url);
        $crawler = new Crawler();
        $crawler->addHTMLContent($html);
        $user_id = array();
        $link_id = $crawler->filterXPath('//div[@class="seller-info-name"]/a')->attr('href');
        $user_id = str_replace('/', '', preg_replace('/(.*)user(.*)profile(.*)/sm', '\2', $link_id));
        echo $user_id;
        */
    return new Response();
    //var_dump($rows[0]);
    }
}