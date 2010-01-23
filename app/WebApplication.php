<?php

class WebApplication extends Ostric\WebApplication{
    
    public function getHomePage(){
        return new Page\HomePage();
    }
    
}
