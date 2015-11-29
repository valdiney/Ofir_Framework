<?php 
class Home extends Controller
{
    protected $view;
    protected $model;

    public function __construct()
    {
    	$this->view = new View();
    	$this->model = $this->load_model('user.User');
    }

	public function index()
	{
        $description = 'Welcome to Ofir, this is a project development 
                        of the PHP-Framework, of  students for students.  
                        what do you think about help me develop this project?';

        $this->view->set('page_title', 'Ofir-Framework');
        $this->view->set('description', $description);
		$this->view->make('home.home');
	}
}