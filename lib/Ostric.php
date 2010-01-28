<?php

class Ostric
{
    private static $pathDirs = array(__DIR__);
    
    public static function autoload($class)
    {
        if (class_exists($class)) {
            return false;
        }

        foreach (self::$pathDirs as $dir) {
            
            $class_path = $dir.'/'.str_replace('\\','/',$class) . '.php';
            if (file_exists($class_path)) {
                require $class_path;
                return true;
            } 
            
            $classes_path = preg_replace('/\/[A-Za-z0-9_]+\.php/','.php',$class_path);
            if(file_exists($classes_path)) {
                require $classes_path;
                return true;
            }
            
            $class_path = $dir.'/'.str_replace('_','/',$class) . '.php';
            if (file_exists($class_path)) {
                require $class_path;
                return true;
            } 
            
        }
        
        return false;
        
    }
    
    
    
    public static function load()
    {
        $dirs = func_get_args();
        foreach($dirs as $dir) {
            array_push(self::$pathDirs,$dir);
        }
        
        spl_autoload_register(array('Ostric','autoload'));
        
    }
}
