<?php
interface Grabber
{
    public function __construct ($url, $cat);
    public function getContent();
    public function getProduct();
    public function getCode($dom_xpath);
    public function getImage($dom_xpath);
    public function getLink($dom_xpath);
    public function getTitle($dom_xpath);
    public function getPrice($dom_xpath);
    public function getStar($dom_xpath);
    public function getBrand($dom_xpath);
    public function getCategory($dom_xpath);
    public function getProducts();
}