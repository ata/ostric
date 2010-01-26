<?php

require_once 'lib/Ostric.php';
Ostric::addDirs();
Ostric::load(__DIR__ . '/app');

$ref = new Ostric\Base\Reflection\ReflectionClass('Page\HomePage');

echo $ref->isInject();
