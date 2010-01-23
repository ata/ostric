<?php

class A{
    public static $class = null;
    public function some(){
        
    }
}

class B extends A{
    
}

echo B::$class;
