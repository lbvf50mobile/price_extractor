<?php
echo "This is a price extractor\n";
$file_name = "https://shop.4audio.rs/shop/slusalice/sennheiser-hd-4-40-bt-wireless/";

$html = file_get_contents($file_name);


// Extract scripts that have: <script type="application/ld+json">

$dom = new DOMDocument();
@$dom->loadHTML($html);
$xpath = new DOMXpath($dom);
$scripts = $xpath->query("//script[@type='application/ld+json']");

$result_array = [];

echo "Amounts of applicaiton/ld+json: $scripts->length\n";
$checker = function($arr,$key,$value){
    return array_key_exists($key,$arr) &&  $value == $arr[$key]; 
};
$prices_extractor_from_offers = function($arr, $name, &$result_array){
    if(array_key_exists('offers', $arr) && is_array($arr['offers'])){
        foreach($arr['offers'] as $offer){
            if(array_key_exists('price', $offer)){
                $price = $offer['price'];
                array_push($result_array, $price);
            }
        }
    }
};


foreach ($scripts as $node) {
    $schema = json_decode($node->nodeValue, true);
    var_dump($schema);
    if( $checker($schema, "@context", 'https://schema.org/')){
        if( $checker($schema, "@type", 'Product') && array_key_exists('name', $schema)){
            $name = $schema['name'];
            $result_array[$name] = [];
            $prices_extractor_from_offers($schema, $name, $result_array);
        }
    }   
}

var_dump($result_array);