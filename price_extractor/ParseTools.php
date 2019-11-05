<?php
namespace ParseTools;

class ParseToolDump{
    public $dom;
    public $xpath;
    public $name;
    public $price;
    function __construct($dom,$xpath){
        $this->dom = $dom;
        $this->xpath = $xpath;

    }
    function test(){
        return true;
    }
    function extractNameAndPrice(){
        $this->name = "ParseToolDump";
        $this->price = 10000;
    }
}