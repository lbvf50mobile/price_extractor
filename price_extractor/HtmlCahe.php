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
        foreach($this->sources_list as $source){
            array_push($this->results, new CachedElemet($source));
        }
    }
    function getIterator(){
        return new \ArrayIterator($this->results);
    }
}

class CachedElemet {
    public $html;
    public $source;
    public $type;
    public $cache_file_name;

    private $is_url;
    private $cache_dir;
    

    function __construct($resource_path){
        $this->cache_dir = dirname(__FILE__)."/cache";
        $this->source = $resource_path;
        $this->setType();
        $this->setHtml();
       
    }

    protected function setHtml(){
        $this->html = $this->getHtml();
    }
    protected function setType(){
        $this->defineUrlOrFile();
        $this->type = $this->is_url ? "url" : "file";
    }
    protected function defineUrlOrFile(){
        return $this->is_url = (0 == preg_match('/^http/',$this->source)) ? false : true;
    }
    protected function defineCacheFileName(){
        $this->cache_file_name = $this->is_url ? md5($this->source) : $this->source;
        $this->cache_file_name = $this->cache_dir.'/'.$this->cache_file_name;
    }
    protected function getHtml(){
        if(file_exists($this->cache_file_name)){
            return file_get_contents($this->cache_file_name);
        }else{
            return $this->createCacheForUncachedFile();
        }
    }
    protected function createCacheForUncachedFile(){
        if($this->is_url){
            $html = file_get_contents($this->source);
            file_put_contents($this->cache_file_name, $html);
            return $html;
        }else{
            throw new Exception('Unexisted file: '.$this->source);
        }
    }
}