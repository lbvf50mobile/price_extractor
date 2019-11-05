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
            new CachedElemet("httpone"),
            new CachedElemet("two"),
            new CachedElemet("httpthree"),
        ];
    }
    function getIterator(){
        return new \ArrayIterator($this->results);
    }
}

class CachedElemet {
    public  $html;
    public  $source;
    public $type;
    private $is_url;

    function __construct($resource_path){
        $this->cache_dir = dirname(__FILE__)."/cache";
        $this->source = $resource_path;
        $this->setType();
        $this->setHtml();
       
    }
    protected function setHtml(){
        $this->html = "this is html";
    }
    protected function setType(){
        $this->defineUrlOrFile();
        $this->type = $this->is_url ? "url" : "file";
    }
    protected function defineUrlOrFile(){
        return $this->is_url = (0 == preg_match('/^http/',$this->source)) ? false : true;
    }
}