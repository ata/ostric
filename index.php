<?php

use Ostric;



define('APP_DIR', dirname(__FILE__));
require 'lib/Ostric/Request.php';
require 'controllers/SiteController.php';

$url = '/site/nama.html';
$req = new Ostric\Request();
$req->setPattern('/:controller/:action.html');
var_dump($req->parseURL($url));

echo $req->getPattern() ."\n";

var_dump($req->getKeywords());





$refClass = new ReflectionClass('SiteController');

$methods = $refClass->getMethods();
/**
 * $request = array(
 * 				
 * 			);
 */

$request = array();

foreach($methods as $refMethod) {
	preg_match_all('/\@url\ (?P<method>\w+)\ (?P<pattern>[\w\ \/\:\.\-\,]+)/',$refMethod->getDocComment(),$subpatten);
	print_r($subpatten);
	echo "---------------------\n";
}
