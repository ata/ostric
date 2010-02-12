<?php

require_once 'lib/Ostric.php';

define('S_TMP', __DIR__ . '/tmp');


Ostric::load(
    __DIR__ . '/example',
    __DIR__ . '/tests'
);


class A extends Ostric\Component{
    public $value = 1;
}


class B extends Ostric\Component{
    
    public $value;
    
    public function __construct()
    {
        parent::__construct();
        if($this->value == null){
            $this->value = new A;
        }
    }
}


$c = new B();
$c->value->value ++;
//header('content-type: text/plain');
//session_destroy();
echo "Value: {$c->value->value}<br/>\n";
print_r($_SESSION);

