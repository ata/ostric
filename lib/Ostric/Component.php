<?php

namespace Ostric;

use Ostric\Util\Inflector;

abstract class Component extends Object
{
    
    private $storage;
    protected $id;
    protected $components = array();
    
    public function __construct($id)
    {
        $this->id = $id;
        $this->storage = Storage::getInstance();
        $this->loadFromStorage();
        
    }
    
    public function add(Component $component)
    {
        $this->components[] = $component;
    }
    
    public function getId()
    {
        return $this->id;
    }
    
    public function getClassId()
    {
        return Inflector::dotted(get_class($this));
    }
    
    private function saveToStorage()
    {
        // save dynamic property
        $dynamic = get_object_vars($this);
        $static = $this->getClass()->getStaticProperties();
        $this->storage->saveProperties($this->getClassId(),array_merge($dynamic,$static));
        
        
        
    }
    
    private function loadFromStorage()
    {
        $properties = $this->storage->loadProperties($this->getClassId());
        foreach ($properties as $name => $value) {
            if(property_exists($this,$name)){
                $ref = new \ReflectionProperty(get_class($this),$name);
                if ($ref->isStatic()) {
                    static::$$name = $value;
                } else {
                    $this->$name = $value;
                }
            } else {
                $this->$name = $value;
            }
            
        }
    }
    
    public function __destruct()
    {
        $this->saveToStorage();
    }
    

}
