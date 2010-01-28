<?php

require_once 'lib/Ostric.php';

Ostric::load(
    __DIR__ . '/example',
    __DIR__ . '/tests'
);

/*
class A implements Serializable{
    private $a = 'A';
    protected $b = 'B';
    public $c = 'C';
}*/

class B{
    private $a;
    protected $b;
    public $c;
    
    public function __construct($a,$b,$c)
    {
        $this->a = $a;
        $this->b = $b;
        $this->c = $c;
    }
    
    public function __wakeup()
    {
        echo "wakeup\n";
    }
    
    public function __sleep()
    {
        return array('a');
    }
}

//$b = new B('A','B','C');

//var_dump($b);

session_start();
//$_SESSION['b'] = $b;

var_dump($_SESSION['b']);


