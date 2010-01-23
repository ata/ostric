<?php

class WebApplication extends Ostric\WebApplication{
    
    public function __construct()
    {
        parent::__construct();
        
    }
    
    public function getHomePage(){
        return 'Page\HomePage';
    }
    
}
