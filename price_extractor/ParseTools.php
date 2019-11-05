<?php
namespace ParseTools;

function just_load($name){
    $dir = dirname(__FILE__)."/parsing_tools/$name.php";
    require_once($dir);
}

$class_set = ["ParseToolDump","JsonLd"];
foreach($class_set as $class){
    just_load($class);
}
