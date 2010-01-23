<?php

namespace Page;

use Ostric\Components\Page;

class BasePage extends Page
{
    protected $hello = 'Hello World';
    
    public function run(){
        
    }
    
    public function getTitle()
    {
        return 'Base Page';
    }
    
    
}
