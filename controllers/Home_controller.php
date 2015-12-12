<?php 
class Home extends Controller
{
    protected $view;
    protected $model;

    public function __construct()
    {
    	$this->view = new View();
        $this->view->layout_name('default_layout');
    	$this->model = $this->load_model('user.User');
    }

	public function index()
	{   
        $data['page_title'] = 'Ofir-Framework';
        $data['description'] = 'Welcome to Ofir, this is a project development 
                                of the PHP-Framework, develop of the students to students.  
                                what do you think about help me to develop this project?';

        $this->view->set('data', $data);
		$this->view->make('home.home');
	}

    public function cadastrar()
    {
        $data['login'] = Input::in_post('login');

        if ($this->model->save($data)) {
            echo 'Login cadastrado.';
        } else {
            echo 'Erro ao cadastrar.';
        }
    }

    public function editar()
    {
        $id = Input::in_get('id');
        $data['login'] = Input::in_post('login');

        if ($this->model->update($data, $id)) {
            echo 'Login Editado';
        } else {
            echo 'Erro ao Editar';
        }
    }

    public function show()
    {
        foreach ($this->model->listar() as $itens) {
            if ($itens % 2 == 0) {
                echo "Par Number = {$itens} <br>";
            } else {
                echo "Imper Number = {$itens} <br>";
            }
        }
    }

    public function login()
    {
        if ($this->model->user_exist(array("login" => "admin@admin.com", "password" => "admin"))) {
            Redirect::to_route('home.show');
        } else {
            echo "Nao existe";
        }
    }
}