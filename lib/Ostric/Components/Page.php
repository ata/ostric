<?php

namespace Ostric\Components;

use Ostric\Base\Component;

abstract class Page extends Component
{
    
    private $child;
    
    public function getChild()
    {
        return $this->getTemplate($this);
    }
    
    public function render()
    {
        $parrentRef = $this->getReflection()->getParentClass();
        
        if (!$parrentRef->isAbstract()) {
            echo $this->getTemplate($parrentRef->newInstance());
        } else {
            echo $this->getTemplate($this);
        }
        
    }
}
