<?php

namespace Goal;

use Ostric\Component\Markup\Form;

class Guest{
    
    public $name;
    public $email;
    public $comment;
}

class GuestForm extends Form
{
    private $guest = null;
    private $guests = array();
    
    public function __construct($id, $model)
    {
        parent::__construct();
        
        $this->guest = new Guest();
        
        $this->guest->name = new InputText();
        $this->guest->email = new InputText();
        $this->guest->comment = new TextArea();
    }
    
    public function onSubmit()
    {
        array_push($this->guests, $this->guest);
    }
}
