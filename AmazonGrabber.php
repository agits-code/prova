<?php


class AmazonGrabber extends MainGrabber
{


    public function getContent()               // html sezione con prodotti
    {
        if (preg_match('/<div class="s-main-slot s-result-list s-search-results sg-row">(.*)<\/div>/s', $this->url, $risultato1)){
            $content1 = $risultato1[1];
        } else {
            echo "nulla trovato";
            exit();
        };
        return $this->content = $content1;
    }

    public function getProduct()// array html singoli prodotti
    {
        $dom = new DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML($this->content);
        libxml_clear_errors();
        $dom->preserveWhiteSpace = false;
        $xpath = new DOMXpath($dom);
        $doc = $xpath->query("//div[@data-component-type='s-search-result']");
        foreach($doc as $item){
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
                                               // proprietà prodotto:
    public function getCode($dom_xpath)
    {
        $asin = $dom_xpath->query("//@data-asin");
        return $asin->item(0)->nodeValue;
    }

    public function getImage($dom_xpath)
    {
        $image = $dom_xpath->query("//img/@src");
        return $image->item(0)->nodeValue;
    }

    public function getLink($dom_xpath)
    {
        $link = $dom_xpath->query("//h2/a[@class='a-link-normal a-text-normal']/@href");
        return "https://www.amazon.it".($link->item(0)->nodeValue);
    }

    public function getTitle($dom_xpath)
    {
        $title = $dom_xpath->query("//h2/a[@class='a-link-normal a-text-normal']");
        return trim($title->item(0)->nodeValue);
    }

    public function getPrice($dom_xpath)
    {
        $price = $dom_xpath->query("//a[@class='a-size-base a-link-normal a-text-normal']//span[@class='a-offscreen']");
        if(is_object($price->item(0))) {
            return $this->Getfloat( $price->item(0)->nodeValue);
        } else {
            return null;
        }
    }

    public function getStar($dom_xpath)
    {
        $star = $dom_xpath->query("//div[@class='a-row a-size-small']//span[1]");
        if(is_object($star->item(1))) {
            return $this->Getfloat( $star->item(0)->nodeValue);
        } else {
            return null;
        }
    }

    public function getBrand($dom_xpath){
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
            }
        }
    }

    public function getCategory($dom_xpath)
    {
        return $this->category;
    }


}