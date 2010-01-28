<?php
namespace Ostric;

class View
{
    /**
     * Full path layout, merupakan lokasi tempat keberadaan layout
     * @type String
     */
    private $layout;
    /**
     * full path template for view
     * @type string
     */
    private $template;
    
    private $pathDir;
    
    private $extension = '.php';
    
    private $defaultLayout = 'default';
    
    private $controllerName;
    
    private $actionName  = null;
    
    private $content;
    
    private $requestHandler;
    
    private $_attributes = array();
    
    public function __construct(RequestHandler $requestHander = null)
    {
       $this->requestHander = $requestHander;
    }
    
    
    
    public function __set($a,$v) 
    {
        $this->_attributes[$a] = $v;
    }
    
    public function __get($a)
    {
        return $this->_attributes[$a];
    }
    
    public function setControllerName($controllerName)
    {
        $this->controllerName = $controllerName;
    }
    
    public function setActionName($actionName)
    {
        $this->actionName = $actionName;
    }
    
    public function setTemplate($template) 
    {
        if($this->controllerName === null){
            $this->template = $template;
        } else {
            $this->template =  $this->pathDir .'/'. $this->controllerName .'/'
                               . $template . $this->extension;
            $this->setLayout($this->defaultLayout);
        }
        
    }
    
    public function setLayout($layout)
    {
        if($this->controllerName === null){
            $this->layout = $layout;
        } else {
            $this->layout =  $this->pathDir .'/layouts/'
                               . $layout . $this->extension;
        }
        
    }
    
    public function getContent()
    {
        return $this->content;
    }
    
    public function render()
    {
        /*
        if($this->template === null) {
            $this->setTemplate();
        }
        */
        ob_start();
        include($this->template);
        $this->content = ob_get_clean();
        
        if($this->layout !== null) {
            ob_start();
            include($this->layout);
            $this->content = ob_get_clean();
        }
        
        echo $this->content;
        
    }
}
