# Ofir Framework

# Description

Welcome to Ofir. This is a Project Development of the PHP-Framework. Developed by student to students. What do you think about contribute with this project?

The Ofir is very easy to use. You just need install and run in your server. <br>
Ofir uses the Model-View-Controller approach, which allows great separation between logic and presentation. 

# What I need at this moment?

I need to create a powerful class to work with SQL query. My objective is abstracting the SQL language in the Application.

# Examples

### Example of the Model class:

```php
class User extends Model
{
    protected $table = 'user';
}
```

### Example of the Controller class:

```php
class UserController extends Controller 
{
    protected $users;
    protected $view;

    public function __construct()
    {
        $this->users = $this->model('Users');
    }

    public function index()
    {
        $title = 'All users';
        $users = $this->users->select()->getAll();
        return $this->view('home.index', compact('title', 'users'));
    }
}
```

### Example of the View:

```php
<?php foreach ($users as $user): ?>
    <b>Name:</b> <?php $user->name;?> <br>
    <b>Email:</b> <?php $user->email;?> <br>
<?php endforeach; ?>
```

### then...

Accessing the url `http://[site.example]/users/`, you will see the all users from you database.

# Changelog:

- [v2.1.0](https://github.com/valdiney/Ofir_Framework-0.1/releases/tag/v2.0.0) - A new version has been created.
- [v1.0.0](https://github.com/valdiney/Ofir_Framework-0.1/releases/tag/v1.0.0) 
