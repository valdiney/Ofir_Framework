<?php 
class Home_Controller extends Controller
{
    protected $user;
    protected $view;

    public function __construct($models = array())
    {
        $this->user = $models['User'];
        $this->view = $this->view();
    }

    public function index()
    {   
        $this->view->layout('default_layout');
    
        $data['title'] = 'This is Ofir Framework';
        $data['usuarios'] = $this->user->select()->get_all();

        return $this->view->make('home.home', $data);
    }
}