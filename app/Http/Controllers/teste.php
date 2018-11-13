<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


include_once ("/var/www/public/simplehtmldom_1_5/simple_html_dom.php");

class teste extends Controller
{
    //<?php



		public function getTemperatura(){
// Create DOM from URL or file
$html = file_get_html( "http://www.tempoagora.com.br/previsao-do-tempo/brasil/Petrolina-PE", false, null, 0 );

			preg_match_all('/<p class=\"pb-5 bold\">(.*?)<\/p>/', $html, $result);
			var_dump($result[1]); 

// Find all images 
foreach($html->find('img') as $element) 
       echo $element->src . '<br>';

// Find all links 
foreach($html->find('a') as $element) 
       echo $element->href . '<br>';

		}
		

}
