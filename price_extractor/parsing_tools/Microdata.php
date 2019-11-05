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
            return true;
        };
        return false;
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
        if($this->has_name($node) && $this->has_price($node)){
            return true;
        }
        return false;
    }
    protected function has_name($node){
        $select_query = "//*[@itemprop='name']";
        $answer = $this->xpath->query($select_query,$node);
        if(count($answer) > 0){
            $this->name =  $answer[0]->nodeValue;
            return true;

        }
        return false;
    }
    protected function has_price($node){
        $select_query = "//*[@itemprop='price']";
        $answer = $this->xpath->query($select_query,$node);
        if(count($answer) > 0){
            $this->price =  $answer[0]->nodeValue;
            return true;

        }
        return false;
    }
   
}