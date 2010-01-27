<?php

namespace Ostric\Components;

use Ostric\Base\Component;

abstract class Page extends Component
{
    
    public function getChild()
    {
        return $this->getTemplate($this);
    }
    
    public function render()
    {
        $parrentRef = $this->getReflection()->getParentClass();
        
        while(!$parrentRef->isAbstract()) {
            //echo $this->getTemplate($parrentRef->newInstance());
            $currentRef = $parrentRef;
            $parrentRef = $parrentRef->getParentClass();
        }
        
        echo $this->getTemplate($currentRef->newInstance());
        
    }
}
