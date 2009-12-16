<?php

namespace Ostric;

class OldRequest{

    private $controllerName;
    private $actionName;
    private $params = array();
    
    public function __construct()
    {
        if(isset($_SERVER['PATH_INFO'])) {
            $this->params = explode('/',substr($_SERVER['PATH_INFO'],1));
            
            $this->controllerName = ucfirst(array_shift($this->params));
            if(count($this->params) > 0) {
                $this->actionName = array_shift($this->params);
            }
            
        }
    }

    
    public function getControllerName()
    {
        return $this->controllerName;
    }
    
    public function getActionName()
    {
        return $this->actionName;
    }
    
    public function getParams()
    {
        return $this->params;
    }
    
    public function setControllerName($controllerName)
    {
        $this->controllerName = $controllerName;
    }
    
    public function setActionName($actionName)
    {
        $this->actionName = $actionName;
    }
    
}
