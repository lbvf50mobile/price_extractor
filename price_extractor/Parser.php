<?php
namespace PriceExtractor;
echo "Good day\n";

class Parser{
    public $price;
    public $name;
    protected $html;
    protected $dom;
    protected $xpath;

    function __construct($html){
        echo "I'm in the parser constuctor \n";
        $this->html = $html;
        $this->generateDomAndXpath();
        $this->setNameAndPrice();
    }

    protected  function setNameAndPrice(){
        echo "I set a price and name \n";
        $this->price = 1;
        $this->name = "Test name";
    }

    protected function generateDomAndXpath(){
        $this->dom = new \DOMDocument();
        @$this->dom->loadHTML($this->html);
        $this->xpath = new \DOMXpath($this->dom);
    }
}