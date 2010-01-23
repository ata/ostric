<?php

require_once 'lib/Ostric.php';
Ostric::addDirs();
Ostric::load(__DIR__ . '/app');

$ref = new ReflectionClass('Page\HomePage');

var_dump($ref->getParentClass());

