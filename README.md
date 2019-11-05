# Rich snippet test tool

I need simple PHP script that will return "Product name" and "Product price" from given url by reading schema (rich snippets from that url).

## Urls

- [Schema main documentation](http://schema.org/docs/gs.html)
- [Product](http://schema.org/Product)
    - [Name](http://schema.org/name)
- [Offer](http://schema.org/Offer)
    - [Price](http://schema.org/price)
- https://shop.4audio.rs/shop/slusalice/sennheiser-hd-4-40-bt-wireless/

## Usage

`php start.php` - just run in CLI `start.php` scrip.

### Classes:

- `PriceExtractor\Cache\HtmlCache` class that get a list of **urls** and **text files**, create cache for **urls**
-  Stores chache at the `price_extractor/cache` folder has a method `$html_cache->clearCacheDirecotry();` to purge all files and caches
-  Object of this class is iterable and return `html`, `source`, `type` properties.

```php
$sources_list = [
    "https://shop.4audio.rs/shop/slusalice/sennheiser-hd-4-40-bt-wireless/",
];
$html_cache = new PriceExtractor\Cache\HtmlCache($sources_list);



foreach($html_cache as $key => $element){
    echo $key."----------------------\n";
    echo "TYPE: $element->type \n";
    echo "SOURCE: $element->source \n";
    echo "CACHE_FILE_NAME: " . $element->getCacheName() ." \n";
    
    // echo "HTML: $element->html \n";
}

// !important! It is possble to clear the cache folder.
// $html_cache->clearCacheDirecotry();

```

## Algorithm

1. Get the html content of the page and deliver into the script variable.
2. [Extract](https://www.coralnodes.com/parsing-html-in-php/) all `<script type="application/ld+json">` elements from this html. Using [xpath](https://www.w3schools.com/xml/xml_xpath.asp) = `//script[@type='application/ld+json']`
3. Iterate over all `<script type="application/ld+json">`  that been found, and select ones that has `"@context" = 'https://schema.org/'`
4. If this **ld+json** has a `"@type" == 'Product'` and have a `name` start to collect prices for this **name** from **offers**

## TODO and Dairy

[Set of task and implementation of them](dairy.md) - here is a journal of the project.