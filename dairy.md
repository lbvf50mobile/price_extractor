
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
- `count(//*[@itemtype='http://schema.org/Product'])`  https://stackoverflow.com/a/54577243/8574922

- `21:20` continue with xPath.
- `22:02` Done with microdata 2 hrs

### 2019.11.06 Wednesday November

- `17:43` finished in `18:05` **20minutes** Separate the extracting node value into the separtate method to keep the code dry. 
- `18:06` Read about xPath. `18:50` pause => **44minutes**
- `19:30` continue working with XPath. `20:23` pause => **53minutes**
- `21:12` contitue 
    - https://en.wikipedia.org/wiki/XPath
    - https://goessner.net/articles/JsonPath/
- Idea of the algorithm
    - Get all JSON+LD
    - Convert them to XML
    - USE xPath on them.
    - https://stackoverflow.com/questions/9544840/php-json-or-array-to-xml
- `22:32` paused.
    

### 2019.11.07 Thursday November

- `15:19`  `16:13 (pause) 1h; 17:02.`Set main questions and find aswers on them.
    - What is **Json Ld**?
    - What is **RDF**?
        - https://www.w3.org/RDF/
        - https://youtu.be/ldl0m-5zLz4
        - http://rdfa.info/
    - What is the main Structures at the [ProductPage](https://schema.org/Product)
    - What is the structures represented at the [shop.4auido](https://shop.4audio.rs/shop/slusalice/sennheiser-hd-4-40-bt-wireless/) and [rcshop](https://rcshop.rs/proizvod/dji-phantom-4-pro-plus-sa-dve-dodatne-baterije/)

- `15:35` Working with **JSON LD**
    - https://json-ld.org/learn.html
    - https://youtu.be/4x_xzT5eF5Q
    - [What is JSON LD](https://youtu.be/vioCbTo3C-4)
    - https://json-ld.org/playground/ I able to use N-Quads
- `17:17` I need to extract all JSON LD from the two pages.
    - `18:17` pause
    - `18:36` continue
    - `19:20 -> 21:20 1hr:40minutes` **DONE** have an I dea how to wield with different types of JSON-LD schemas.
        - this is algorithm
            - Get **scipt** JSON-LD.
            - check **@context == chema.org**
            - travers down till find **@type == Product** with **name**
            - travers sub tree till find **@type == Offer** with **price**
        - ![tree-travesal](imgs/tree-traversal.png)


### 2019.11.08 Frideay November

- `17:16`  Start simplifying `the start.php`
    - `17:27` done spend 10 minutes;
    - `17:35` wrote a letter to a Ian (10 minutes.)
- `20:05` Working with documentaion.
    - `20:16` [JSON-LD: Core Markup](https://youtu.be/UmvWk_TQ30A)
    - `20:23` pause
- `22:04` [JSON-LD: Compaction and Expansion](https://youtu.be/UmvWk_TQ30A)

### 2019.11.09 Saturday November

- `15:55` Continue with JSON-LD
    - [JSON-LD Linked Data Signatures](https://youtu.be/QdUZaYeQblY)

### 2019.11.12 Tuesday November

- `16:55` Continue with RDFa and http://schema.org/

### 2019.11.27 Wednesday November

- `16:55` Cointinue the project.