# Ofir_Framework-0.1
This is the development of the new version of the Ofir, a simple php framework.

# Description
Welcome to Ofir, this is a project development of the PHP-Framework, develop of the students to students. what do you think about help me to develop this project?

# Some Examples


I'm trying write a powerful class to work with SQL query. <br>
This is the controller, and  using some methods of the Persistence class.

````php

class Users extends Controller
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
        # Set the layout that this view will use
        $this->view->layout('default_layout');

        # Load this file to be used into of this view
        $this->view->with_files('menu_left', 'layouts.menu_left');
        
        # Select all users with pagination
        $data['users'] = Pagination::paginator(2, $this->user->select()->get_all());

        # Set the view that will be used for this method
        return $this->view->make('home.home', $data);
    }

    
    # Return the first user from the table
    public function first_user()
    {
    	return $this->user->select()->get_first();
    }
    
    # Return the last user from the table
    public function last_user()
    {
    	return $this->user->select()->get_last();
    }
    
    # Return all users from the table
    public function select_all()
    {
    	return $this->user->select()->get_all();
    }
    
    # Using this structure, you can return a lot of the queries combination
    public function get_admin_user()
    {
    	$query = $this->user->select()
    	         ->where('login', '=', 'valdiney.2@hotmail.com')
    	         ->and_too('perfil', '=', 'admin');

    	return $this->user->prepare($query);
    }
}

```

