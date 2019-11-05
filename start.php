<?php

include('price_extractor/HtmlCahe.php');


$sources_list = [
    "https://shop.4audio.rs/shop/slusalice/sennheiser-hd-4-40-bt-wireless/",
];
$html_cache = new PriceExtractor\Cache\HtmlCache($sources_list);

include('price_extractor/Parser.php'); // Parser is responsible for ProductName/OfferPrice extraction from html;

foreach($html_cache as $key => $element){
    echo $key."----------------------\n";
    echo "SOURCE: $element->source \n";
    echo "CACHE_FILE_NAME: " . $element->getCacheName() ." \n";

    $parser = new PriceExtractor\Parser($element->html);

    echo "NAME: $parser->name \n";
    echo "PRICE: $parser->price \n";

}


// !important! It is possble to clear the cache folder.
// $html_cache->clearCacheDirecotry();
