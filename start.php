<?php

include('PriceExtractor.php');
include('price_extractor/HtmlCahe.php');
$sources_list = [
    "https://shop.4audio.rs/shop/slusalice/sennheiser-hd-4-40-bt-wireless/",
];
$html_cache = new PriceExtractor\Cache\HtmlCache($sources_list);



foreach($html_cache as $key => $element){
    echo $key."----------------------\n";
    echo "TYPE: $element->type \n";
    echo "SOURCE: $element->source \n";
    echo "CACHE_FILE_NAME: " . $element->getCacheName() ." \n";
}

