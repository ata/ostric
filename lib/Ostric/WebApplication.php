<?php
namespace Ostric;

abstract class WebApplication
{
    
    public function __construct()
    {
        $class = $this->getHomePage();
        new $class;
    }
    
    abstract public function getHomePage();
}
