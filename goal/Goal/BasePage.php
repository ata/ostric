<?php

namespace Goal;

use Ostric\Component\Markup\Page;
use Ostric\Component\Markup\Label;

abstract class BasePage extends Page
{
    
    public function __construct()
    {
        $this->add($this->getTitle());
        $this->add(new SideBarPanel('sidebar'));
        
    }
    
    public function getTitle()
    {
        return new Label('title','Base Page');
    }
    
}
