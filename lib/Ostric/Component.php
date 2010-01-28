<?php

namespace Ostric;

use Ostric\Util\Inflector;

abstract class Component extends Object
{
    
    private $storage;
    protected $id;
    
    public function __construct($id)
    {
        $this->id = $id;
        $this->storage = Storage::getInstance();
        $this->init();
        
    }
    
    private function init()
    {
        $components = $this->storage->getComponents($this);
        
        foreach ($components as $component) {
            if (property_exists($this, $component->getId())) {
                $name = $component->getId();
                $this->$name = $component;
            }
        }
        
    }
    
    
    public function getClassId()
    {
        return Inflector::dotted($this->getClass()->getName());
    }
    
    public function getId()
    {
        return $this->id;
    }
    
    
    public function add(Component $component)
    {
        $this->storage->addComponent($this, $component);
    }
    

}
