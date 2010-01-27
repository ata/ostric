<?php

namespace Ostric;

use Ostric\Util\Inflector;

abstract class Component extends BaseClass
{
    private $_id;
    private $_properties = array();
    private $_components = array();
    
    public function __set($name, $value)
    {
        if ($name =='id') {
            $this->setId($value);
        } else {
            $this->_properties[$name] = $value;
        }
    }
    
    public function __get($name)
    {
        if ($name == 'id') {
            return $this->getId();
        }
        return $this->_properties[$name];
    }
    
    /**
     * injects = array('id'=>$objectValue)
     */
    public function __construct($id, $value)
    {
        $this->id = $id;
    }
    
    public function setId($id)
    {
        $this->_id  =   Inflector::dotted($this->getClass()->getName()) 
                        . '.' . $id;
    }
    
    public function getId()
    {
        return $this->_id;
    }
    
    public function add(Component $component)
    {
        $this->_
    }
    
}
