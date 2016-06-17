<?php 
class Home_Controller extends Controller
{
    protected $user;
    protected $view;
    protected $layout_pricipal;

    public function __construct(Array $models)
    {
        $this->user = $models['User'];
        $this->view = $this->view();
        $this->layout_pricipal =  $this->view->layout('default_layout');
    }

    public function index()
    {   
        $this->layout_pricipal;
    
        $title = 'This is Ofir Framework';
        return $this->view->make('home.home', compact('title'));
    }
}