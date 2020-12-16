<?php


class EpriceGrabber extends MainGrabber
{



    public function getContent()
    {
        $pattern = '/<section class="ep_box_prodListing ">(.*?)<\/section>/s';

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
        foreach($xpath->query("//a[@class='ep_prodListing ' or @class='ep_prodListing v_tag']") as $item){
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

    public function getCode($dom_xpath)
    {
        $sku = $dom_xpath->query("//@sku");
        return "d-".$sku->item(0)->nodeValue;
    }

    public function getImage($dom_xpath)
    {
        $image = $dom_xpath->query("//span[@class='ep_prodImg']//img/@src");
        return $image->item(0)->nodeValue;
    }

    public function getLink($dom_xpath)
    {
        $link = $dom_xpath->query("//a/@href");
        return $link->item(0)->nodeValue;
    }

    public function getTitle($dom_xpath)
    {
        $title = $dom_xpath->query("//p[@class='ep_prodName']");
        return trim($title->item(0)->nodeValue);
    }

    public function getPrice($dom_xpath)
    {
        $price = $dom_xpath->query("//div[@class='ep_contPrice']//span[@class='ep_itemPrice']");
        if(is_object($price->item(0))) {
            return $this->Getfloat( $price->item(0)->nodeValue);
        } else {
            return null;
        }
    }

    public function getStar($dom_xpath)
    {
        $star = $dom_xpath->query("//div[@class='ep_prodContTxt']//p[@class='ep_prodRating']/span/@class");

        if(is_object($star->item(0))) {
            return $this->Getfloat( $star->item(0)->nodeValue);
        } else {
            return null;
        }

    }

    public function getBrand($dom_xpath)
    {
        $title = $dom_xpath->query("//div[@class='ep_prodBrand']/img/@alt");
        return $title->item(0)->nodeValue;
    }
}