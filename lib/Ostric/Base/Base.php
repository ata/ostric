<?php

namespace Ostric\Base;

class Base
{
    public function getReflection()
    {
        return new \ReflectionClass(get_class($this));
    }
}
