<?php

namespace Ostric;

class Storage extends Object
{
    private static $instance = null;
    
    public function __construct()
    {
        session_save_path(S_TMP);
        session_start();
        
        echo session_save_path();
    }

    
    
    public function __set($key,$value)
    {
        $_SESSION['ostric'][$key] = $value;
    }
    
    
    public function __get($key)
    {
        return $_SESSION['ostric'][$key];
    }
    
    public function saveProperties($key,$value)
    {
        $_SESSION['ostric']['properties'][$key] = $value;
    }
    
    public function loadProperties($key)
    {
        if(isset($_SESSION['ostric']['properties'][$key])) {
            return $_SESSION['ostric']['properties'][$key];
        } else {
            return array();
        }
    }
    
    
    public static function getInstance()
    {
        if(self::$instance == null) {
            self::$instance = new Storage;
        }
        return self::$instance;
    }
}
