<?php
namespace ParseTools;
class Microdata{
    public $dom;
    public $xpath;
    public $name;
    public $price;
    function __construct($dom,$xpath){
        $this->dom = $dom;
        $this->xpath = $xpath;

    }
    function test(){
        $this->extractNameAndPrice();
        return false;
    }
    function extractNameAndPrice(){
        $this->name = "This is Microdata";
        $this->price = 10000;
    }
}