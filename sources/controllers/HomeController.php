<?php
class HomeController extends BaseController
{
    protected $layout = 'secondary';
    
    public function index()
    {
        $title = 'This is Ofir Framework';
        return $this->view('home.home', compact('title'));
    }
}
