<?php
echo "This is a price extractor\n";
$url = "https://shop.4audio.rs/shop/slusalice/sennheiser-hd-4-40-bt-wireless/";

echo "Scaning urs: $url\n";

$html = file_get_contents($url);

include('PriceExtractor.php');

$extractor = new PriceExtractor();
$result_array = $extractor->getNamesAndPrices($html);

print_r($result_array);