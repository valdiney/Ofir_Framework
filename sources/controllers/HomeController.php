<?php

class HomeController extends BaseController
{
    protected $user;
    protected $view;
    protected $layout_pricipal;

    public function __construct()
    {
        $this->user = $this->model('User');
        $this->view = $this->view();
        $this->layout_pricipal = $this->view->layout('default-layout');
    }

    public function index()
    {
        $this->layout_pricipal;

        $title = 'This is Ofir Framework';
        return $this->view->make('home.home', compact('title'));
	}

	public function teste() {
		echo 'teste';
	}
}
