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
        $this->view->set('title', 'Show Users');
        $this->view->set('all_users', $this->select_all_users());
        $this->view->make('home.home');
    }

    public function select_all_users()
    {
        return $this->model->select()->get_all();
    }

    public function delete()
    {
        $id = Input::in_get('id');

        if ($this->model->delete($id)) {
            Session::flash('success', 'Usuario deletado com Sucesso.');
            Redirect::to_route('home.index');
        } else {
            echo "Erro ao tentar deletar usuario";
        }
    }
}