<?php

namespace Ostric;

use Ostric\Util\Inflector;

class Loader
{
    
    private static $paths = array();
    
    public static function autoload($class)
    {
        if (class_exists($class)) {
            return false;
        }
        
        foreach (self::$paths as $path) {
            
            $class_path = $path.'/'.str_replace('\\','/',$class) . '.php';
            if (file_exists($class_path)) {
                require $class_path;
                return true;
            } 
            
            $classes_path = preg_replace('/\/[A-Za-z0-9_]+\.php/','.php',$class_path);
            if(file_exists($classes_path)) {
                require $classes_path;
                return true;
            }
            
            $class_path = $path.'/'.str_replace('_','/',$class) . '.php';
            if (file_exists($class_path)) {
                require $class_path;
                return true;
            }
            
            $class_path = $path.'/'.Inflector::lower($class). '.php';
            if (file_exists($class_path)) {
                require $class_path;
                return true;
            }
            
        }
        
        return false;
        
    }
    
    
    
    public static function load()
    {
        self::$paths = func_get_args();
        self::$paths[] = dirname(__DIR__);
        $paths = func_get_args();
        spl_autoload_register(array('Ostric\Loader','autoload'));
        
    }
}
