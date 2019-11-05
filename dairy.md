
## Diary and ToDo

### 2019.11.05 Tuesday November

- `11:53` I want to reduce time of testing for this purpose I going to create an object. On creation this object get list of urls and files. For urls it create cache, files it just read. and it retun set of htmls as a [DomeNodeList](https://www.php.net/manual/en/class.domnodelist.php)
    - Set list of *urls* and *files* into the constructor
    - object is [Traversable](https://www.php.net/manual/en/class.traversable.php) loop over it. On each iteration it has **html** and **type** properties.
    - **Puropse of this task: 1) reduce amount of testing time do not leach the HTML from the internet. 2) Ability to create test cases myslef for examile a case when Offerst could have array of be a single state object saved by this key.**
- `14:01` Start implementing. **[spend 2hrs:20minuts on caching]**
    - now working with https://shop.4audio.rs/shop/slusalice/sennheiser-hd-4-40-bt-wireless/ requires 2 seconds
    - `15:55` now after the cache the time of wokring is 0.1 sec - 20 times faster;
    - `16:20` task is done.

- `17:05` Now I going to create a Class stucture 
    - `Parser` it is a main class it got **html** string as an argument, and convert's it to the `new DOMXpath($dom);`
    -  then the `Parser` selects the `ParsingTool`, that going to test this element. And there will be plenty of such testing tools
        - for JSON-LD first varian whith Offers like array
        - for JSON-LD second variant with Offers like object
        - For Microdata
        - for RDFa.
- `17:19` Implementing
    -`18:06` create class that uses ohter classes for parsing, an interface is created.
    -`19:16` add JSON parsing.
    - `19:36` Wrote a documentation, now working with `https://rcshop.rs/proizvod/dji-phantom-4-pro-plus-sa-dve-dodatne-baterije/` it has `itemtype="http://schema.org/Product"` it is a Microdata `http://schema.org/Offer`
        - itemtype="http://schema.org/Product"
        - itemprop="name"
        - http://schema.org/Offer
        - itemtype="http://schema.org/Offer"
        - itemprop="price"
- I get an idea how select what I need to select, it seach in tree and rize up till the name that would be a cool thing.
- `20:06` start to imlement `Microdata`. 
    - https://pcfoto.biz/boya-by-dmr7.html
    - https://dijaspora.shop/s-box-plb-2044-nosac-za-zakrivljene-ekrane-3e2cf1a6-e621-3591-87f4-2194fbdc4886 
    
