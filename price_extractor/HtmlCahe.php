<?php
namespace PriceExtractor\Cache;

class HtmlCache implements \IteratorAggregate{
    function __construct($sources_list){
        $this->sources_list = $sources_list;
        $this->results = array();
        $this->cache_dir = dirname(__FILE__)."/cache"; 
        $this->check_cache_dir_exists();
        $this->fill_results();
    }
    function check_cache_dir_exists(){
        if(!file_exists($this->cache_dir)){
            mkdir($this->cache_dir);
        }
    }
    function fill_results(){
        $this->results = [
            new CachedElemet("one"),
            new CachedElemet("two"),
            new CachedElemet("three"),
        ];
    }
    function getIterator(){
        return new \ArrayIterator($this->results);
    }
}

class CachedElemet {
    function __construct($resource_path){
        $this->html = "this is html";
        $this->source = $resource_path;
        $this->type = "uri";
    }
}