<?php
namespace Ostric;
class RequestHandler
{
    private $request;
    private $defaultController = 'Site';
    private $defaultAction = 'index';
    private $controllerPostfix = 'Controller';
    private $view;
    
    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    
    public function run()
    {
        
        if($this->request->getControllerName() === null) {
            $this->request->setControllerName($this->defaultController);
        }
        if($this->request->getActionName() === null) {
            $this->request->setActionName($this->defaultAction);
        }
        
        $cn = $this->request->getControllerName() . $this->controllerPostfix;
        
        $c = new $cn();
        
        $m = $this->request->getActionName();
        
        call_user_func_array(array($c,$m),
            $this->request->getParams()
        );
    }
    
    public function setDefaultController($defaultController)
    {
        $this->defaultController = $defaultController;
    }
    
    public function setDefaultAction($defaultAction)
    {
        $this->defaultAction =  $defaultAction;
    }
    
    public function setControllerPostfix($controllerPostfix)
    {
        $this->controllerPostfix = $controllerPostfix;
    }
    
    public function setViewDir($viewDir)
    {
        $this->viewDir = $viewDir;
    }
    
}
