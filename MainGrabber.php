<?php


abstract class MainGrabber implements Grabber
{

    Protected $category;
    Protected $url;
    Protected $content;
    Protected $product;
    Protected $products;

    public function __construct ($url, $cat){
        $this->category = $cat;
        if ($url){
            $ch = curl_init($url);
            curl_setopt_array($ch, array(
                CURLOPT_HTTPHEADER  => array('User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safari/537.36',
                    'Sec-Fetch-Dest: document'),
                CURLOPT_RETURNTRANSFER  =>true,
                CURLOPT_VERBOSE     => 1
            ));
            $this->url = curl_exec($ch);
            curl_close($ch);


        } else {
            echo "sito non raggiungibile";
            exit();
        }
    }

    public function getProducts()
    {
        $this->getContent();
        $this->getProduct();
        foreach ($this->product as $prod) {

            $xpath = $this->getXpath($prod);

            $product['code'] = $this->getCode($xpath);

            $product['image'] = $this->getImage($xpath);

            $product['link'] = $this->getLink($xpath);

            $product['title'] = $this->getTitle($xpath);

            $product['price'] = $this->getPrice($xpath);

            $product['brand'] = $this->getBrand($xpath);

            $product['star'] = $this->getStar($xpath);

            $product['category'] = $this->getCategory($xpath);

            $this->products[]=$product;
        }
        return $this->products;
    }

    public function Getfloat($str) {
        if(strstr($str, ",")) {
            $str = str_replace(".", "", $str); // replace dots (thousand seps) with blancs
            $str = str_replace(",", ".", $str); // replace ',' with '.'
        }

        if(preg_match("#([0-9\.]+)#", $str, $match)) { // search for number that may contain '.'
            return floatval($match[0]);
        } else {
            return floatval($str); // take some last chances with floatval
        }
    }

}