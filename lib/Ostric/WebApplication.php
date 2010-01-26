<?php

namespace Ostric;

abstract class WebApplication
{
    
    protected $injecteds;
    
    
    public function run()
    {
        $page = $this->getHomePage();
        $page->run();
        $page->render();
        
    }
    
    public function inject($key, $object)
    {
        
    }
    
    abstract public function getHomePage();
}
