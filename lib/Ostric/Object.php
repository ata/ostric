<?php

namespace Ostric;

class Object
{
    private $_class = null;
    
    public function getClass()
    {
        if ($this->class != null) {
            return $this->_class;
        }
        $this->_class = new \ReflectionClass(get_class($this));
        return $this->_class;
    }
    
    
    public function getParentClass()
    {
        return $this->getClass()->getParentClass();
    }
    
    public function getFileName()
    {
        return $this->getClass()->getFileName();
    }
    
    public function getNamespace()
    {
        return $this->getClass()->getFileName();
    }
    
    public function getShortName()
    {
        return $this->getClass()->getShortName();
    }
    
}
