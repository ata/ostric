<?php
namespace Goal;

use Ostric\Markup\Html\WebPage;

use Component\SideBarPanel;

abstract class BasePage extends WebPage
{
    public $title = 'Base Page';
    public function __construct()
    {
        $this->add(new SideBarPanel('sidebar'));
        $this->add(new SideBarPanel('sidebar'));
    }
}
