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
     * $pathInfo => '/home/index/1.html'
     * $pattern => '/{controller}/{action}/{id}.html'
     */
    
    public function setPattern($simplepattern)
    {
        $this->parsePattern($simplepattern);
    }
    
    public function parseURL($pathInfo)
    {
        preg_match($this->pattern, $pathInfo, $this->keywords);
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

$webroot = '/Project/simpleMVC/url.php';

$mng = URLManager::getInstance( $webroot . '/{controller}/{action}/{id}.html');

$mng->parseURL($_SERVER['REQUEST_URI']);

echo "controller: {$mng->controller} <br/>action: {$mng->action}<br/>id: {$mng->id}";

/*
function simple($str)
{
    $search = array("{","}","/", ".");
    $replace = array("(?P<",">\w+)","\/","\.");
    
    $newstr =  "/" . str_replace($search,$replace, $str) . "/";
    return $newstr;
}


$url = "/home/index/2.html";

$pattern = "/\/(?P<controller>\w+)\/(?P<action>\w+)\/(?P<id>\w+).html/";

$simplepattern = "/{controller}/{action}/{id}.html";

preg_match(simple($simplepattern), $url,$matches);

preg_match($pattern, $url,$matches2);
print_r($matches);
*/


