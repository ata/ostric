<?php

namespace Ostric;

class Storage
{
    private static $instance = null;
    
    public function __construct()
    {
        session_start();
    }

    
    
    public function __set($key,$value)
    {
        $_SESSION[$key] = $value;
    }
    
    public function __get($key)
    {
        return $_SESSION[$key];
    }
    
    public function isIsset($key)
    {
        return isset($_SESSION[$key]);
    }
    
    
    
    public function isIssetComponent(Component $component)
    {
        return isset($_SESSION['component'][$component->getClassId()][$component->getId()]);
    }
    
    public function addComponent($class, Component $component)
    {
        //if (!isset($_SESSION['component'][$class->getClassId()][$component->getId()])) {
            $_SESSION['component'][$class->getClassId()][$component->getId()] = $component;
            return true;
        //} 
        //return false;
    }
    
    public function getComponents(Component $component)
    {
        if(isset($_SESSION['component'][$component->getClassId()])) {
            return $_SESSION['component'][$component->getClassId()];
        }
        
        return array();
    }
    
    
    
    public function addOrReplaceComponent(Component $component)
    {
        $_SESSION['component'][$component->getClassId()][$component->getId()] = $component;
    }
    
    
    public static function getInstance()
    {
        if(self::$instance == null) {
            self::$instance = new Storage;
        }
        return self::$instance;
    }
    
}
