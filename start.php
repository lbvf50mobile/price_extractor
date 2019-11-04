<?php
echo "This is a price extractor\n";
$file_name = "https://shop.4audio.rs/shop/slusalice/sennheiser-hd-4-40-bt-wireless/";

$html = file_get_contents($file_name);


// Extract scripts that have: <script type="application/ld+json">

$dom = new DOMDocument();
@$dom->loadHTML($html);
$xpath = new DOMXpath($dom);
$scripts = $xpath->query("//script[@type='application/ld+json']");

echo "Amounts of applicaiton/ld+json: $scripts->length\n";
$checker = function($arr,$key,$value){
    return array_key_exists($key,$arr) &&  $value == $arr[$key]; 
};
foreach ($scripts as $node) {
    $schema = json_decode($node->nodeValue, true);
    var_dump($schema);
    if( $checker($schema, "@context", 'https://schema.org/')){
        echo "True";
    }   
}