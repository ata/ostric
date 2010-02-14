<?php
namespace Goal;

use Ostric\Component\Markup\Panel;
use Ostric\Component\Markup\Link;
use Ostric\Component\DataList;

class SideBarPanel extends Panel
{
    
    public function __construct($id)
    {
        parent::__construct($id);
        
        $sidemenus = new DataList('sidemenus');
        $this->add($sidemenus);
        // example data for datalist
        $urls = array(  'google' => 'http://google.com',
                        'yahoo' => 'http://yahoo.com'
                        'facebook' => 'http://facebook.com');
        
        // entry data for list item
        foreach($urls as $label => $url)
        {
            $menulink = new Link('menulink',$url);
            $sidemenus->addItem($menulink);
            $menulink->add(new Label('menulabel'));
        }
    }
}
