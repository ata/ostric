<?php
namespace Goal;

use Ostric\Component\Markup\Panel;
use Ostric\Component\Markup\Form;
use Ostric\Component\Markup\Form\InputText;
use Ostric\Component\Markup\Form\TextArea;
use Ostric\Component\Markup\Container;
use Ostric\Component\DataList;

class Guest{
    
    public $name;
    public $email;
    public $comment;
}

class GuestForm extends Form
{
    
    public function __construct($id, $guest)
    {
        parent::__construct($id, $guest);
        $this->add(new InputText('name'));
        $this->add(new InputText('email'));
        $this->add(new TextArea('comment'));
        
    }
    
    public function onSubmit()
    {
        array_push(GuestPage::$guests,$this->guest);
    }
}

class GuestPage extends BasePage
{
    public static $guests = array();
    
    public function __construct()
    {
        $this->add(new GuestBookForm('form', new Guest()));
        
        $posts = new DataList('posts');
        $this->add($posts);
        
        // entry data for list item
        foreach(self::$guests as $guest)
        {
            $posts->addItem(new Label('name',$guest->name));
            $posts->addItem(new Label('comment',$guest->comment));
        }
        
    }
}
