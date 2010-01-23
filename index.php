<?php

require_once 'lib/Ostric.php';

Ostric::load(__DIR__ . '/app');

$app = new WebApplication();
$app->run();

