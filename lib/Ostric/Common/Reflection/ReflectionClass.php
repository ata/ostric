<?php

namespace Ostric\Base\Reflection;

class ReflectionClass extends \ReflectionClass{
    
    public function isInject()
    {
        $doc = $this->getDocComment();
        preg_match('/(?P<inject>[@inject])/i', $doc, $match);
        if(array_key_exists('inject',$match)) {
            return true;
        }
        
        return false;
        
    }
}
