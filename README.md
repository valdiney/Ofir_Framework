# Ofir Framework

## Description

Welcome to Ofir. This is a Project Development of the PHP Framework. Developed by student to students. What do you think about contribute with this project?

The Ofir is very easy to use. You just need install and run in your server.\
Ofir uses the Model-View-Controller approach, which allows great separation between logic and presentation. 

## Instalation

To get help in initializing you can see [our documentation for install](https://github.com/valdiney/Ofir_Framework-0.1/tree/master/docs/install.md).\
For example, you can work with [nginx](https://github.com/valdiney/Ofir_Framework-0.1/tree/master/docs/install.md#nginx) or [apache](https://github.com/valdiney/Ofir_Framework-0.1/tree/master/docs/install.md#apache).

We are using `composer` to load some packages and our classes (especially).\
Get help to install composer in your machine ([installing composer](https://github.com/valdiney/Ofir_Framework-0.1/tree/master/docs/install.md#composer)).

Copy the file `.env.sample` to `.env` and configure it, we writed a step-by-step then you can [see about the enviroment](https://github.com/valdiney/Ofir_Framework-0.1/tree/master/docs/install.md#environment). Then [configure your development environment](https://github.com/valdiney/Ofir_Framework-0.1/tree/master/docs/install.md#development-environment).

**I think that you are ready!**

## What I need at this moment?

I need to create a powerful class to work with SQL query. My objective is abstracting the SQL language in the Application.

If you can help us, go to our issues (#41) and send a pull request.

---

## Some examples

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
    <b>Name:</b> <?php $user->name;?>
    <b>Email:</b> <?php $user->email;?>
<?php endforeach; ?>
```

### then...

Accessing the url `http://[site.example]/users/`, you will see the all users from you database.

## Changelog:

- [v2.1.2](https://github.com/valdiney/Ofir_Framework-0.1/releases/tag/v2.1.2)
- [v2.1.1](https://github.com/valdiney/Ofir_Framework-0.1/releases/tag/v2.1.1)
- [v2.1.0](https://github.com/valdiney/Ofir_Framework-0.1/releases/tag/v2.0.0)
- [v1.0.0](https://github.com/valdiney/Ofir_Framework-0.1/releases/tag/v1.0.0) 
