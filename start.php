<?php
echo "This is a price extractor\n";
$file_name = "https://shop.4audio.rs/shop/slusalice/sennheiser-hd-4-40-bt-wireless/";

$html = file_get_contents($file_name);

echo substr($html,0,25);