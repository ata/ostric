<?php

class SiteController{
    
    public function index(){
        $view = new View();
        $view->nama = 'Ahmad Tanwir';
        $view->nim = '0668965';
        $view->setLayout(APP_DIR . '/views/layouts/default.php');
        $view->setTemplate(APP_DIR . '/views/site/index.php');
        $view->render();
    }
    
}
