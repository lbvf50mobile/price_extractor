<?php
namespace ParseTools;
class JsonLd{
    public $dom;
    public $xpath;
    public $name;
    public $price;

    protected $name_and_price_are_found;


    function __construct($dom,$xpath){
        $this->dom = $dom;
        $this->xpath = $xpath;
    }

    function test(){
        $this->scripts = $this->xpath->query("//script[@type='application/ld+json']");
        return $this->loop_over_xpaths();
          
    }
  
    protected function loop_over_xpaths(){
        foreach($this->scripts as $node){
            $schema = json_decode($node->nodeValue, true);
            $name_and_price = $this->schema_contains_product_name_and_offer_price($schema);
            if($name_and_price){
                $this->name = $name_and_price['name'];
                $this->price = $name_and_price['price'];
                return true;
            }
        }
        return false;
    }

    protected function schema_contains_product_name_and_offer_price($schema){
        $this->name_and_price_are_found = false;
        if(! $this->valid_schema($schema)){
            return false;
        }

        return $this->dfs_product($schema);
    }

    protected function dfs_product($node){
        if($this->name_and_price_are_found){
            return false;
        }
        $name = $this->node_is_valid_product_with_name($node);
        if($name){
            $this->name_and_price_are_found = true;
            return array('name'=> $name, 'price' => "tmpPrice");
        }else{
            foreach($node as $element){
                if(is_array($element)){
                    $answer = $this->dfs_product($element);
                    if($answer){
                        return $answer;
                    }
                }
            }
        }
        return false;
    }


    protected function valid_schema($schema){
        return $this->key_has_value($schema,"@context", 'https://schema.org/');
    }

    protected function node_is_valid_product_with_name($node){
        $is_product = $this->key_has_value($node, "@type", 'Product');
        $has_name = $this->has_key($node,'name');
        if($is_product && $has_name){
            return $node['name'];
        }
        return false;
    }

    protected function node_is_valid_offer_with_price($node){
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

