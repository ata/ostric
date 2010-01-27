<?php

use Ostric\WebApplication;

class GoalApplication extends WebApplication
{
    public function __construct()
    {
        
    }
    
    public function getHomePage()
    {
        return 'Goal\GuestPage';
    }
    
}
