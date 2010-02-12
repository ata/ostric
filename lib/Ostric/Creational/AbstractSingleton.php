<?php

namespace Ostric\Pattern\Creational;

abstract class AbstractSingleton
{
    private static $instance = array();
    
    final private function __construct()
    {
        $called_class = get_called_class();
        if (isset(self::$instance[$called_class])) {
            throw new \Exception("{$called_class} is already exist");
        }
        static::init();
        
    }
    
    final private function __clone()
    {
        // clonning object is not allowed
    }
    
    protected function init()
    {
        // default init
    }
    
    public static function getInstance()
    {
        $called_class = get_called_class();
        if(isset(self::$instance[$called_class])) { 
            return self::$instance[$called_class];
        }
        return self::$instance[$called_class] = new static;
    }
}

