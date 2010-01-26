<?php

namespace Ostric\Base;

abstract class Component extends BaseClass
{
    
    protected $id = null;
    
    public function __construct($id, array $injects = array())
    {
        $this->id = $id;
    }
    
    public function render()
    {
        echo $this->getTemplate($this);
    }

}
