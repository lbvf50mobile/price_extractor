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
        $this->price = 5;
        $this->name = 5;
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
}