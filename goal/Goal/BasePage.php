<?php

namespace Goal;

use Ostric\Markup\Html\WebPage;

abstract class BasePage extends WebPage
{
    public $title = 'Base Page';
    
    public function __construct()
    {
        $this->sidebar = new SideBarPanel();
        $this->form = new GuestBookForm();
    }
}
