<?php
echo "This is a price extractor\n";
$url = "https://shop.4audio.rs/shop/slusalice/sennheiser-hd-4-40-bt-wireless/";

echo "Scaning url: $url\n";

$html = file_get_contents($url);

include('PriceExtractor.php');

$extractor = new PriceExtractor();
$result_array = $extractor->getNamesAndPrices($html);

echo "Product name: $extractor->first_name \n";
echo "Product price: $extractor->first_price \n";

print_r($result_array);