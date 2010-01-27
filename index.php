<?php

require_once 'lib/Ostric.php';

Ostric::load(
    __DIR__ . '/example',
    __DIR__ . '/tests'
);

class Component extends Ostric\Base\Component{
    
};
$cls = Ostric\Util\Inflector::classify('/page/component/a');
//echo $cls;
new $cls;

/*
$c = new Component('name');
echo $c->id ."\n\n";

echo gettype('')."\n";
echo gettype(0)."\n";
echo gettype(0.1)."\n";
echo gettype(1.0)."\n";
echo gettype(true)."\n";
echo gettype(array())."\n";
echo gettype($c)."\n";
echo gettype(NULL)."\n";
echo gettype(function(){return '';})."\n";
*/



