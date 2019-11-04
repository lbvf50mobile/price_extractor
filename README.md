# Rich snippet test tool

I need simple PHP script that will return "Product name" and "Product price" from given url by reading schema (rich snippets from that url).

## Urls

- [Schema main documentation](http://schema.org/docs/gs.html)
- [Product](http://schema.org/Product)
    - [Name](http://schema.org/name)
- [Offer](http://schema.org/Offer)
    - [Price](http://schema.org/price)
- https://shop.4audio.rs/shop/slusalice/sennheiser-hd-4-40-bt-wireless/

## Algorithm.

1. Get the html content of the page and deliver into the script variable.
2. [Extract](https://www.coralnodes.com/parsing-html-in-php/) all `<script type="application/ld+json">` elements from this html. Using [xpath](https://www.w3schools.com/xml/xml_xpath.asp) = `//script[@type='application/ld+json']`
3. Iterate over all `<script type="application/ld+json">`  that been found, and select ones that has `"@context" = 'https://schema.org/'`