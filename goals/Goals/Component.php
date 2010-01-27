<?php

namespace Goals\Component;

use Ostric\Markup\Html\Panel;


class SideBarPanel extends Panel
{
    public $sidemenu = array();
    
    public function __construct()
    {
        $this->sidemenu = array('side menu1','side menu1');
        
    }
}
