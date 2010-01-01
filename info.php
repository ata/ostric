<?php
//phpinfo();

class WebHander{
    public function get($regex,$func){
        
    }
    public function post($url,$func){}
    public function delete($url,$func){}
    public function put(){$url,$func}
}



class Hanlder{
    private $h;
    
    public function __construct(WebHander $h)
    {
        $h->get('/');
    }
    
}

