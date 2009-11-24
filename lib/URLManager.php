<?php

class URLManager
{
    private $keywords = array();
    
    private static $instance;
    
    private $pattern;
    
    public function __construct($simplepattern = null)
    {
        $this->setPattern($simplepattern);
    }
    
    /**
     * @example:
     *      $pattern => '/{controller}/{action}/{id}.html'
     */
    
    public function setPattern($simplepattern)
    {
        $this->parsePattern($simplepattern);
    }
    
    public function parseURL($url)
    {
        preg_match($this->pattern, $url, $this->keywords);
    }
    
    protected function parsePattern($simplepattern)
    {
        $search = array("{","}","/", ".");
        $replace = array("(?P<",">\w+)","\/","\.");
        $this->pattern = "/" . str_replace($search,$replace, $simplepattern) . "/";
    }
    
    public function __get($key)
    {
        return $this->keywords[$key];
    }
    
    public static function getInstance($pattern = null)
    {
        if(URLManager::$instance == null) {
            URLManager::$instance = new URLManager($pattern);
        }
        return URLManager::$instance;
    }
    
}
