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
        $this->check_for_product();
        return false;
    }
    function extractNameAndPrice(){
        $this->name = "This is Microdata";
        $this->price = 10000;
    }
    protected function check_for_product(){
        $query = "count(//*[@itemtype='http://schema.org/Product'])";
        $entries = $this->xpath->evaluate($query, $this->dom);
        echo "There are $entries products\n";
    }
}