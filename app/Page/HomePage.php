<?php

namespace Page;

class HomePage extends BasePage
{
    /**
     * @inject
     */
    private $testInject;
    
    public function run(){
        
    }
    
    public function getTitle()
    {
        return 'Home Page';
    }
    
}
