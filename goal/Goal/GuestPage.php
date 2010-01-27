<?php
namespace Goal;

class GuestForm extends BasePage
{
    public $title = 'Guest Page';
    public $form = null;
    
    public function __construct()
    {
        $this->form = new GuestBookForm();
    }
}
