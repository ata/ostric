<?php

define('APP_DIR', dirname(__FILE__));

function __autoload($className){
    if(file_exists(APP_DIR . "/lib/$className.php")) {
        require_once(APP_DIR ."/lib/$className.php");
    } else {
        require_once(APP_DIR . "/controllers/$className.php");
    }
        
}

$handler = new RequestHandler(new Request());
$handler->run();

