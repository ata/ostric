<?php


class Ostric
{
    private static $includeDirs = array();
    private static $libDir = __DIR__;
    private static $applicationClass = null;
    
    public static function setApplicationClass($class)
    {
        self::$applicationClass = $class;
    }
    
    public static function autoload($class)
    {
        if (class_exists($class)) {
            return false;
        }
        
        $class_path = self::$libDir.'/'.str_replace('\\','/',$class) . '.php';
        
        if(file_exists($class_path)) {
            require $class_path;
            return true;
        }
        
        foreach (self::$includeDirs as $dir) {
            $class_path = $dir.'/'.str_replace('\\','/',$class) . '.php';
            if(file_exists($class_path)) {
                require $class_path;
                return true;
            }
            
        }
        
        return false;
        
    }
    
    public function addDirs()
    {
        $dirs = func_get_args();
        foreach($dirs as $dir) {
            array_push(self::$includeDirs,$dir);
        }
    
    }
    
    
    public static function load()
    {
        spl_autoload_register(array('Ostric','autoload'));
    }
    
    public static function run($appClass = null)
    {
        $applicationClass = $appClass;
        
        if ($applicationClass == null) {
            $applicationClass = self::$applicationClass;
        }
        
        self::load();
        
        new $applicationClass;
        
        
    }
}
