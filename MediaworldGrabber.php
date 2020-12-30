<?php


class MediaworldGrabber extends MainGrabber
{
    public function getContent()
    {

            $this->content = json_decode($this->url)->CatalogEntryView;

        return $this->content;
    }

    public function getProduct()
    {
          foreach ($this->content as $item) {
              $this->product[] = $item;
          }
        return $this->product;
    }

    public function getCode($xpath)
    {
        return $xpath->partNumber;
    }

    public function getImage($xpath)
    {
       return "https://www.mediaworld.it" .$xpath->fullImage;
    }

    public function getLink($xpath)
    {
       return "https://www.mediaworld.it/product/" .$xpath->partNumber;
    }

    public function getTitle($xpath)
    {
      return $xpath->name;
    }

    public function getPrice($xpath)
    {
       return $this->Getfloat($xpath->Price[0]->priceValue);
    }

    public function getXpath($item)
    {
         return $item;

    }

    public function getBrand($xpath)
    {
        $strg = $xpath->name;
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

    public function getStar($xpath)
    {

            return null;

    }

    public function getCategory($dom_xpath)
    {
        return $this->category;
    }

}