<?php


  //$url = "https://en.wikipedia.org/wiki/Web_scraping";
  //$url = "https://www.tudocelular.com";
  //$url = "../php-1/index.php";
  $url = "http://project1/";

  $content = file_get_contents($url);


  //$dom = new DOMDocument('1.0', 'UTF-8');
  $dom = new DOMDocument;
  libxml_use_internal_errors(true);
  $dom->loadHTML($content);

  libxml_clear_errors();

  //$file ="prova21.txt";
  //file_put_contents($file, $content);

  $pattern = "#href=\"(.*?)[\"]#";
  preg_match_all($pattern, $content, $risultato);


 echo "<pre>";
 var_dump($risultato[1]);
 //var_dump($dom->firstChild );
echo "</pre>";