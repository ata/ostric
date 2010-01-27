<?php

namespace Goal;

class Guest{
    
    public $name;
    public $email;
    public $comment;
}

class GuestForm extends Form
{
    public $guest = null;
    public $guests = array();
    
    public function __construct()
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
