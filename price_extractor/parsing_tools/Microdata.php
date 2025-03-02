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
        return $this->has_name($node) && $this->has_price($node);
    }
    protected function has_name($node){
        return $this->extract_and_set_property($node,"//*[@itemprop='name']",$this->name);
    }
    protected function has_price($node){
        return $this->extract_and_set_property($node,"//*[@itemprop='price']",$this->price);
    }

    protected function extract_and_set_property($node, $select_query, &$property){
        $answer = $this->xpath->query($select_query,$node);
        if(count($answer) > 0){
            $property =  $this->extract_value_or_content_attribute($answer[0]);
            return true;
        }
        return false;
    }
    protected function extract_value_or_content_attribute($domnode){
        $value = $domnode->nodeValue;
        return empty($value) ? $domnode ->attributes->getNamedItem('content')->nodeValue : $value;
    }
   
}