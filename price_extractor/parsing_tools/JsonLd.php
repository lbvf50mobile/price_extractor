<?php
namespace ParseTools;
class JsonLd{
    public $dom;
    public $xpath;
    public $name;
    public $price;

    protected $scripts;
    protected $offers_as_object;
    protected $offers_as_array;
    protected $schema;

    
    function __construct($dom,$xpath){
        $this->dom = $dom;
        $this->xpath = $xpath;

    }
    function test(){
        $this->scripts = $this->xpath->query("//script[@type='application/ld+json']");
        if($this->loop_over_xpaths()){
            $this->extractNameAndPrice();
            return true;
        }
        return false;
    }
    function extractNameAndPrice(){
        $schema = $this->schema;
        $this->name = $schema['name'];
        if($this->offers_as_object){
            $this->price = $schema['offers']['price'];

        }else{
            $this->price = $schema['offers'][0]['price'];
        }
    }

    protected function loop_over_xpaths(){
        foreach($this->scripts as $node){
            $schema = json_decode($node->nodeValue, true);
            $have_attributes = $this->check_has_all_attributes($schema);
            if($have_attributes){
                $this->schema = $schema;
                return true;
            }
        }
        return false;
    }

    protected function check_has_all_attributes($schema){
        $product =  $this->check_product_attributes($schema);
        if($product && ($this->check_offers_as_array($schema['offers']) || $this->check_offers_as_object($schema['offers']))){
            return true;
        }
        return false;

    }
    protected function check_product_attributes($schema){
        $this->offers_as_object = false;
        $this->offers_as_array= false;
        $have_context = $this->check_value_exists_in_array($schema, "@context", 'https://schema.org/');
        $have_type = $this->check_value_exists_in_array($schema, "@type", 'Product');
        $have_name = array_key_exists('name',$schema);
        $have_offers = array_key_exists('offers', $schema);
        return $have_context && $have_type && $have_name && $have_offers;
    }

    protected function check_offers_as_object($offers){
        $has_price = array_key_exists('price',$offers);
        if($has_price){
            $this->offers_as_object = true;
            return true;
        }
        return false;
    }   
    protected function check_offers_as_array($offers){
        $has_zero_indeces = array_key_exists(0,$offers);
        if($has_zero_indeces){
            $has_price = array_key_exists('price',$offers[0]);
            if($has_price){
                $this->offers_as_array = true;
                return true;
            }
        }
        return false;
    } 

    protected function check_value_exists_in_array($arr,$key,$value){
        return array_key_exists($key,$arr) &&  $value == $arr[$key]; 
    }
}

