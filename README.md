# Ofir_Framework-0.1
This is the development of the new version of the Ofir, a simple php framework.

# Description
Welcome to Ofir, this is a project development of the PHP-Framework, develop of the students to students. what do you think about help me to develop this project?

# Some Examples


I'm trying write a powerful class to work with SQL query. <br>
This is the controller, and  using some methods of the Persistence class.

````php

class Usuarios extends Controller
{
    protected $view;
    protected $model;

    public function __construct()
    {
    	$this->view = new View();
    	$this->model = $this->load_model('user.User');
    }
    
    # Return the firts user from the table
    public function first_user()
    {
    	return $this->model->select()->get_first();
    }
    
    # Return the last user from the table
    public function last_user()
    {
    	return $this->model->select()->get_first();
    }
    
    # Return all users from the table
    public function select_all()
    {
    	return $this->model->select()->get_all();
    }
}

```

