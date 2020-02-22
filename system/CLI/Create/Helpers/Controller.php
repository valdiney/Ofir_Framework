<?php

class ControllerName extends BaseController
{
    protected $layout = 'primary';

    public function index()
    {
        return $this->view('home.home');
    }
}
