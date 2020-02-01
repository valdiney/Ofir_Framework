<?php
class HomeController extends BaseController
{
    protected $layout = 'secondary';
    protected $users;

    public function __construct() 
    {
        $this->users = new Users();
    }

    public function index()
    {
        $title = 'This is Ofir Framework';
        return $this->view('home.home', compact('title'));
    }
}
