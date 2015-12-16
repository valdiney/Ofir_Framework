<?php 
class Home extends Controller
{
    protected $model;
    protected $view;

    public function __construct()
    {
        $this->model = $this->load_model('user.User');
        $this->view = $this->view();
    }

    public function index()
    {   
        $this->view->layout('default_layout');
    
        $data['title'] = 'This is Ofir Framework';
        return $this->view->make('home.home', $data);
    }
}