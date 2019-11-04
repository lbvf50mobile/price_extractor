<?php
class PriceExtractor{
    public $first_name = null;
    public $first_price = null;
    function __construct(){
        $this->names_price_tree = [];
        $this->names_price_row = [];
    }
    function getNamesAndPrices($html){
        // Extract scripts that have: <script type="application/ld+json">
            $dom = new DOMDocument();
            @$dom->loadHTML($html);
            $xpath = new DOMXpath($dom);
            $scripts = $xpath->query("//script[@type='application/ld+json']");
            $result_array = [];
            $checker = function($arr,$key,$value){
                return array_key_exists($key,$arr) &&  $value == $arr[$key]; 
            };
            $prices_extractor_from_offers = function($arr, $name, &$result_array){
                if(array_key_exists('offers', $arr) && is_array($arr['offers'])){
                    foreach($arr['offers'] as $offer){
                        if(array_key_exists('price', $offer)){
                            $price = $offer['price'];
                            array_push($result_array[$name], $price);
                        }
                    }
                }
            };
            foreach ($scripts as $node) {
                $schema = json_decode($node->nodeValue, true);
                //var_dump($schema);
                if( $checker($schema, "@context", 'https://schema.org/')){
                    if( $checker($schema, "@type", 'Product') && array_key_exists('name', $schema)){
                        $name = $schema['name'];
                        $result_array[$name] = [];
                        $prices_extractor_from_offers($schema, $name, $result_array);
                    }
                }   
            }
            $this->names_price_tree = $result_array;
            $this->namesPricesPairs();
            return $result_array;
    }
    function namesPricesPairs(){
        $this->first_name = null;
        $this->first_price = null;
        $this->names_price_row = [];
        foreach($this->names_price_tree as $name=>$arr){
            echo "\n--------------\n";
            var_dump($name);
            echo "\n--------------\n";
            var_dump($arr);
            echo "\n--------------\n";
            
           
        }
    }
}