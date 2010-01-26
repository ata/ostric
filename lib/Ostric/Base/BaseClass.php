<?php

namespace Ostric\Base;

use Reflection;

class BaseClass
{
    private $attr;
    
    public function __construct()
    {
        $this->something = 'value';
    }
    
    public function getClass()
    {
        return new Reflection\ReflectionClass(get_class($this));
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
