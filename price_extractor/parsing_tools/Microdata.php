<?php
namespace ParseTools;
class Microdata{
    public $dom;
    public $xpath;
    public $name;
    public $price;

    protected $products;

    function __construct($dom,$xpath){
        $this->dom = $dom;
        $this->xpath = $xpath;

    }
    function test(){
        if($this->check_for_product()){
            $this->extractNameAndPrice();
            return true;
        };
        return false;
    }
    function extractNameAndPrice(){
        $this->name = "This is Microdata";
        $this->price = 10000;
    }
    protected function check_for_product(){
        if($this->get_products() > 0){
            foreach($this->products as $product){
                if($this->valid_product($product)){
                    return true;
                }
            }
        }
        return false;
        
    }
    protected function get_products(){
        $select_query = "//*[@itemtype='http://schema.org/Product']";
        $this->products = $this->xpath->query($select_query);
        return count($this->products);
    }
    protected function valid_product($node){
        return true;
    }
   
}