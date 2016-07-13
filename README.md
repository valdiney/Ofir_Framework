# Ofir_Framework-0.1
This is the development of the new version of the Ofir, a simple php framework.

# Description
Welcome to Ofir, this is a project development of the PHP-Framework, develop of the students to students. what do you think about help me to develop this project?

# Some Examples


I'm trying write a powerful class to work with SQL query. <br>
This is the controller, and  using some methods of the Persistence class.

````php

# Exemplo of the Model class
class User extends Model
{
    protected $table = 'user';
}

```

````php

# Exemplo of the Controller class
class User_Controller extends Controller 
{
    protected $user;
    protected $view;

    public function __construct(Array $models, Array $services)
    {
        $this->user = $models['User'];
        $this->view = $this->view();
    }

    public function index()
    {
        $users = $this->user->select()->get_all();
        return $this->view->make('home.index', compact('user'));
    }
}

```
