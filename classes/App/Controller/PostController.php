<?php
namespace App\Controller;
use Ostric\View;

class PostController
{
    private $view
    public $post;
    public $id;
    
    public function __contruct(View $view)
    {
        $this->view = $view;
    }
    
    public function edit()
    {
        Post::save($this->post);
    }
    /**
     * @url GET /post/view/:id.html
     */
    public function show()
    {
        Post::first($this->id);
    }
}
