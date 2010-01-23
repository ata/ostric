<?php

namespace Ostric;

class Request
{
    const GET = "GET";
    const POST = "POST";
    const PUT = "PUT";
    const DELETE = "DELETE";
    
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
        return preg_match($this->pattern, $url, $this->keywords);
    }
    
    public function setURL($url)
    {
        $this->parseURL($url);
    }
    
    
    protected function parsePattern($simplepattern)
    {
        preg_match_all('/\:(\w+)/i',$simplepattern,$subpatten);
        $replace = array_map(function($n){return "(?P<" . $n . ">\w+)";}, $subpatten[1]);
        $this->pattern = "/\B" . str_replace($subpatten[1],$replace, str_replace(
                            array(':','/','.'),array('','\/','\.'),$simplepattern)
                        ) . "/i";
        
    }
    
    public function getPattern()
    {
        return $this->pattern;
    }
    
    public function __get($key)
    {
        return $this->keywords[$key];
    }
    
    public function getKeywords()
    {
        return $this->keywords;
    }
    
}
