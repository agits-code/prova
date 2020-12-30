<?php


class unieuro
{

    Protected $category;
    Protected $url;
    Protected $content;
    Protected $product;
    Protected $products;

    public function __construct ($url, $cat){
        $this->category = $cat;
        if ($url){
            $this->url = file_get_contents($url);
        } else {
            echo "sito non raggiungibile";
            exit();
        }
    }

    public function getContent()
    {
        $pattern1 = '/<div class="container">(.*)<\/div>/s';

        if (preg_match($pattern1, $this->url, $risultato1)){
            $this->content = $risultato1[0];
        } else {
            echo "nulla trovato";
            exit();
        }
        // <section[^>]*>(.+?)<\/section>

       return $this->content;


    }

    public function getProduct()
    {
        $dom = new DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML($this->content);

        $var = $dom->getElementsByTagName("article");
        var_dump($var->item(2)->attributes->item(1));die();
        foreach($var as $item){
            $this->product[] = $dom->saveHTML($item);
        }
        return $this->product;
    }
}