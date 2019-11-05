<?php
namespace PriceExtractor\Cache;

class HtmlCahe implements \IteratorAggregate{
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
        $this->results = ['one','two','three'];
    }
    function getIterator(){
        return new \ArrayIterator($this->results);
    }
}