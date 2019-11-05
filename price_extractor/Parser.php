<?php
namespace PriceExtractor;
class Parser{
    public $price;
    public $name;
    protected $html;
    protected $dom;
    protected $xpath;

    function __construct($html){
        $this->html = $html;
        $this->dir = dirname(__FILE__); 
        $this->generateDomAndXpath();
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
}