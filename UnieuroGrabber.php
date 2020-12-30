<?php


class UnieuroGrabber extends MainGrabber
{
    public function __construct ($url, $cat){

        if ($url){
            $this->url = file_get_contents($url);
            //var_dump($this->url);die();
        } else {
            echo "sito non raggiungibile";
            exit();
        }
    }

    public function getContent()
    {
        $pattern = '/<section class="hits".*>(.*)<\/section>/s';
        if (preg_match($pattern, $this->url, $risultato)){
            $this->content = $risultato[0];
        } else {
            echo "nulla trovato";
            exit();
        };

        return $this->content;
    }

    public function getProduct()
    {
        $dom = new DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML($this->content);
        libxml_clear_errors();
        $xpath = new DOMXpath($dom);
        $var = $xpath->query("//article");
        foreach($var as $item){
            $this->product[] = $dom->saveHTML($item);
        }
        return $this->product;
    }

    public function getXpath($item){
        $dom = new DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML($item);
        libxml_clear_errors();
        $dom->preserveWhiteSpace = false;
        $xpath = new DOMXpath($dom);
        return $xpath;
    }

    public function getCategory($dom_xpath)
    {
        $var = $dom_xpath->query("//div[@class='category product-tile__category']");
        return trim($var->item(0)->nodeValue);
    }

    public function getCode($dom_xpath)
    {
        $var = $dom_xpath->query("//@data-product-tile-sku");
        return "pid".$var->item(0)->nodeValue;
    }

    public function getImage($dom_xpath)
    {
        $var = $dom_xpath->query("//img/@src");
        return $var->item(0)->nodeValue;
    }

    public function getLink($dom_xpath)
    {
        $var = $dom_xpath->query("//a/@href");
        return "https://www.unieuro.it".$var->item(0)->nodeValue;
    }

    public function getTitle($dom_xpath)
    {
        $var = $dom_xpath->query("//div[@class='title product-tile__title']");
        return trim($var->item(0)->nodeValue);
    }

    public function getPrice($dom_xpath)
    {
        // TODO: Implement getPrice() method. /article/div[1]/div[3]/div[4]/div[2]
        $var = $dom_xpath->query("//div[@class='product-tile__price-container']");
        return $this->Getfloat($var->item(0)->nodeValue);

    }

    public function getStar($dom_xpath)
    {
        return null;
    }

    public function getBrand($dom_xpath)
    {
        $strg = $this->getTitle($dom_xpath);
        $title= str_replace(","," ",$strg);
        $title_words = explode(' ',trim($title));
        $brands = require "Brand.php";

        foreach ($title_words as $word){
            foreach ($brands as $brand){

                if (($product_brand=ucfirst(strtolower($word))) === (ucfirst(strtolower($brand)) )){

                    return $product_brand;

                }
                if ($product_brand === "Redmi"){
                    return "Xiaomi";
                }
                if ($word === "Moto"){
                    return "Motorola";
                }
            }
        }
    }
}