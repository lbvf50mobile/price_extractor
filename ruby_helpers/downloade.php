<?php
// Download files.
$urls = [
    ['shop4audio', 'https://shop.4audio.rs/shop/slusalice/sennheiser-hd-4-40-bt-wireless/'],
    ['rcshoprs','https://rcshop.rs/proizvod/dji-phantom-4-pro-plus-sa-dve-dodatne-baterije/']
];

foreach($urls as $pair){
    $content = file_get_contents($pair[1]);
    file_put_contents(dirname(__FILE__)."/".$pair[0],$content);
}