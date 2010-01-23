<?php

require_once 'lib/Ostric.php';

Ostric::addDirs(__DIR__ . '/classes');
Ostric::load();

Ostric::run('WebApplication');

