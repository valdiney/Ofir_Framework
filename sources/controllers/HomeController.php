<?php

class HomeController extends BaseController
{
    protected $user;
    protected $view;
    protected $layout = 'secondary';

    public function __construct()
    {
        $this->user = $this->model('Users');
    }

    public function index()
    {
        $title = 'This is Ofir Framework';
        return $this->view('home.home', compact('title'));
    }

    public function test() {
        $title = 'Test';
        return $this->layout('secondary')->view('home.teste', compact('title'));
    }
}
