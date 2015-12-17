<?php 
class Home extends Controller
{
    protected $user;
    protected $clientes;
    protected $view;

    public function __construct($models = array())
    {
        $this->user = $models['User'];
        $this->clientes = $models['Clientes'];
        $this->view = $this->view();
    }

    public function index()
    {   
        $this->view->layout('default_layout');
    
        $data['title'] = 'This is Ofir Framework';
        $data['usuarios'] = $this->user->select()->get_all();
        $data['clientes'] = $this->clientes->select()->get_first();
        return $this->view->make('home.home', $data);
    }
}