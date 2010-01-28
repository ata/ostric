<?php
namespace Goal;

use Ostric\Component\Markup\Panel;
use Ostric\Component\DataList;

class SideMenuList extends DataList{
    protected function each($key, $value)
    {
        $menulink = new Link('menulink',$value);
        $this->add($menulink);
        $menulink->add(new Label('menulabel', $key));
    }
}

class SideBarPanel extends Panel
{
    
    public function __construct()
    {
        $urls = array(  'google' => 'http://google.com',
                        'yahoo' => 'http://yahoo.com'
                        'facebook' => 'http://facebook.com');
        $this->add(new SideMenuList('sidemenu',$urls));
    }
}
