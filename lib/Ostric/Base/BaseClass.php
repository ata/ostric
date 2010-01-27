<?php

namespace Ostric\Base;

class BaseClass
{
    private $attr;
    
    public function __construct()
    {
        $this->something = 'value';
    }
    
    public function getClass()
    {
        return new \ReflectionClass(get_class($this));
    }
    
    public function getPublicProperties()
    {
        
    }
    
    public function getPrivateProperties()
    {
        
    }
    
    public function getInjectProperties()
    {
        
    }
    
    public function getProperties()
    {
        
    }
    
    public function getParentClass()
    {
        return $this->getClass()->getParentClass();
    }
    
}
