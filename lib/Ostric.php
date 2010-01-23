<?php


class Ostric
{
    const CLASS_EXTENSION = '.php';
    const TEMPLATE_EXTENSION = '.phtml';
    
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
        
        $classes_path = preg_replace('/\/[A-Za-z0-9_]+\.php/','/classes.php',$class_path);
        
        if(file_exists($classes_path)) {
            require $classes_path;
            return true;
        }
        
        
        
        foreach (self::$includeDirs as $dir) {
            $class_path = $dir.'/'.str_replace('\\','/',$class) . '.php';
            if(file_exists($class_path)) {
                require $class_path;
                return true;
            }
            $classes_path = preg_replace('/\/[A-Za-z0-9_]+\.php/','/classes.php',$class_path);
        
            if(file_exists($classes_path)) {
                require $classes_path;
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
        
        
        $dirs = func_get_args();
        foreach($dirs as $dir) {
            array_push(self::$includeDirs,$dir);
        }
        spl_autoload_register(array('Ostric','autoload'));
        
    }
}
