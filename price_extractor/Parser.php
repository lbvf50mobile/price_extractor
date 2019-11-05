<?php
namespace PriceExtractor;
class Parser{
    public $price;
    public $name;
    protected $html;
    protected $dom;
    protected $xpath;
    protected $parse_tools_list;

    function __construct($html){
        $this->html = $html;
        $this->dir = dirname(__FILE__); 
        $this->generateDomAndXpath();
        $this->loadParsingTools();
        $this->setNameAndPrice();
    }

    protected  function setNameAndPrice(){
        $parsing_object = $this->selectAppropriateParseObject();
        if($parsing_object){
            $this->price = $parsing_object->price;
            $this->name = $parsing_object->name;
        }else{
            $this->price = null;
            $this->name = null;
        }
    }

    protected function generateDomAndXpath(){
        $this->dom = new \DOMDocument();
        @$this->dom->loadHTML($this->html);
        $this->xpath = new \DOMXpath($this->dom);
    }

    protected function loadParsingTools(){
        $this->parse_tools_list = [];
        require_once($this->dir."/ParseTools.php");
        array_push($this->parse_tools_list,new \ParseTools\ParseToolDump($this->dom,$this->xpath));
    }

    protected function selectAppropriateParseObject(){
        $appropriate_object = false;
        foreach($this->parse_tools_list as $test_object){
            if($test_object->test()){
                return $test_object;
            }
        }
        return $appropriate_object;
    }
}