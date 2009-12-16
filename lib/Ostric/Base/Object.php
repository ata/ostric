<?php

namespace Ostric\Base;

class Object
{
    public function getReflection()
    {
        return \ReflectionClass(get_class($this));
    }
}
