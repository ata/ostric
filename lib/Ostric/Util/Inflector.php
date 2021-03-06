<?php

namespace Ostric\Util;

class Inflector
{
    
    /**
     * convert classify to dotted:
     * Path\To\ClassName => path.to.class_name
     */
    public static function dotted($word)
    {
        return str_replace('\\','.',self::lower($word));
    }
    
    
    /**
     * Convert doted, path, tableize to classify
     * - path.to.class_name
     * - path/to/class-name
     * - Path/To/ClassName
     * - class_name
     * - class-name
     * to: Path\To\ClassName
     * 
     */

    public static function classify($word)
    {
        $word = str_replace(" ", "\\", ucwords(strtr($word, "/.", "  ")));
        $word = str_replace(" ", "", ucwords(strtr($word, "_-", "  ")));
        return $word;
    }
    
    public static function lower($word)
    {
        return strtolower(preg_replace('~(?<=\\w)([A-Z])~', '_$1', $word));
    }
    /**
     * convert /home/:something/:id.html
     */
    public static function simplepattern($word)
    {
        return '/' . str_replace('/','\/',
            preg_replace('/(:([a-z0-9_\-]+))/',
            '(?P<$2>[a-z0-9_\-]+)',$word)) .'/';
    }
}
