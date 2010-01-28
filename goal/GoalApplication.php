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
    
    /**
     * array(
     *      '/url/path' => 'NameSpace\ClassName',
     * );
     */
    public function getUrlMapping()
    {
        return array(
            '/costume/url' => 'Namespace\To\ClassName',
            '/*' => '*'
        );
    }
    
    
}
