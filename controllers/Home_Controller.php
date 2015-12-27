<?php 
class Home_Controller extends Controller
{
    protected $user;
    protected $view;

    public function __construct(Array $models)
    {
        $this->user = $models['User'];
        $this->view = $this->view();
    }

    public function index()
    {   
        $this->view->layout('default_layout');
    
        $title = 'This is Ofir Framework';
        return $this->view->make('home.home', compact('title'));
    }
}