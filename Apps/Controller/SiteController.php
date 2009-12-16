<?php

class SiteController{
    /**
     * @url GET /site/:name/:id.html
     * @url GET /lain/:name/:id.html
     */
    public function apapun(UrlRequest $req){
        return "Hello {$req->name} {$req->id}";
    }
    /**
     * @url GET /:nama/:nim.html
     */
    public function test(UrlRequest $req){
        return "Nama: {$req->nama} \n  NIM: {$req->nim}";
    }
    
    public function index(UrlRequest $req = null){
        return "Hello World!";
    }
    
    
}
