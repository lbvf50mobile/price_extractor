<?php
namespace ParseTools;
class JsonLd{
    public $dom;
    public $xpath;
    public $name;
    public $price;


    function __construct($dom,$xpath){
        $this->dom = $dom;
        $this->xpath = $xpath;

        $this->name = "Test";
        $this->price = "1554";

    }

    function test(){
        $this->scripts = $this->xpath->query("//script[@type='application/ld+json']");
        return $this->loop_over_xpaths();
          
    }
  
    protected function loop_over_xpaths(){
        foreach($this->scripts as $node){
            $schema = json_decode($node->nodeValue, true);
            if($this->valid_schema($schema)){
                return true;
            }
        }
        return false;
    }


    protected function valid_schema($schema){
        return $this->key_has_value($schema,"@context", 'https://schema.org/');
    }

    protected function node_is_valid_product($node){
        $is_product = $this->key_has_value($node, "@type", 'Product');
        $has_name = $this->has_key($node,'name');
        if($is_product && $has_name){
            return $node['name'];
        }
        return false;
    }

    protected function node_is_valid_offer($node){
        $is_offer = $this->key_has_value($node, "@type", 'Offer');
        $has_price = $this->has_key($node,'price');
        if($is_offer && $has_price){
            return $node['price'];
        }
        return false;
    }
    

    protected function key_has_value($arr,$key,$value){
        return array_key_exists($key,$arr) &&  $value == $arr[$key]; 
    }
    protected function has_key($arr,$key){
        return array_key_exists($key,$arr); 
    }
}

