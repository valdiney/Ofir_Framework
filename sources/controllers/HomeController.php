<?php

namespace Ofir\Controllers;

use Ofir\Bases\BaseController as BaseController;

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
}
