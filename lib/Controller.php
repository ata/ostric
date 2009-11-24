<?php

class Controller
{
    private $view;
    
    public function __construct(View $view = null)
    {
        $this->view = $view;
    }
    public function render() 
    {
        $this->view->render();
    }
    public function __set($a, $v) 
    {
        $this->view->$a = $v;
    }
}
