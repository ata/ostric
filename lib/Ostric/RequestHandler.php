<?php

/*
 *      This program is free software; you can redistribute it and/or modify
 *      it under the terms of the GNU General Public License as published by
 *      the Free Software Foundation; either version 2 of the License, or
 *      (at your option) any later version.
 *      
 *      This program is distributed in the hope that it will be useful,
 *      but WITHOUT ANY WARRANTY; without even the implied warranty of
 *      MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *      GNU General Public License for more details.
 *      
 *      You should have received a copy of the GNU General Public License
 *      along with this program; if not, write to the Free Software
 *      Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
 *      MA 02110-1301, USA.
 */

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
