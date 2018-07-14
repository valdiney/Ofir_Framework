<?php

class HomeController extends BaseController
{
    protected $user;
    protected $view;
    protected $layoutPrincipal;

    public function __construct()
    {
        $this->user = $this->model('Users');
        $this->layoutPrincipal = $this->layout('default-layout');
    }

    public function index()
    {
        $title = 'This is Ofir Framework';
        return $this->view('home.home', compact('title'));
	}

	public function teste() {
		$title = 'Test';
        return $this->view('home.teste', compact('title'));
	}
}
