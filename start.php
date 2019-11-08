<?php

$sources_list = [
    "https://shop.4audio.rs/shop/slusalice/sennheiser-hd-4-40-bt-wireless/",
    "https://pcfoto.biz/boya-by-dmr7.html",
    "https://dijaspora.shop/s-box-plb-2044-nosac-za-zakrivljene-ekrane-3e2cf1a6-e621-3591-87f4-2194fbdc4886",
    "https://rcshop.rs/proizvod/dji-phantom-4-pro-plus-sa-dve-dodatne-baterije/"
];


include('price_extractor/Parser.php'); // Parser is responsible for ProductName/OfferPrice extraction from html;

foreach($sources_list as $key=>$source){
    echo $key."----------------------\n";
    $html = file_get_contents($source);
    echo "SOURCE: $source \n";
    $parser = new PriceExtractor\Parser($html);
    echo "NAME: $parser->name \n";
    echo "PRICE: $parser->price \n";
}
