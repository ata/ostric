<?php

namespace Ostric;

abstract class WebApplication
{
    
    public function run()
    {
        $page = $this->getHomePage();
        $page->run();
        $page->render();
        
    }
    
    abstract public function getHomePage();
}
