# Ofir Framework

# Description

Welcome to Ofir. This is a Project Development of the PHP-Framework. Developed by student to students. What do you think about contribute with this project?

The Ofir is very easy to use. You just need install and run in your server.\
Ofir uses the Model-View-Controller approach, which allows great separation between logic and presentation. 

# Instalation

To get help in initializing you can go to our wiki.

For example, you can work with `nginx` or `apache`, you just need follow these steps:

### Install composer

We are using `composer` to load some packages and our classes (especially).

Go to [composer website](https://getcomposer.org) and choose one option. If you are using [Linux / Unix / OSX](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx), or [Windows](https://getcomposer.org/doc/00-intro.md#installation-windows).

### Get that project

* You can download this project in a [zip file](https://github.com/valdiney/Ofir_Framework-0.1/archive/master.zip).
* You can clone this repo.
* Or you can `fork this project`.
  * Enjoy to help us :wink:

### Install the necessaries things to init

> $ cd [directory]\
> $ composer install

### Configure your development

If you are on a `Apache Environment`, just create a point from the `public/` folder.

If you are on a `Nginx Environment`, you need to go on our wiki and follow some steps: [Configurando no Nginx](https://github.com/valdiney/Ofir_Framework-0.1/wiki/Configurando-no-Nginx).

### Setuping the enviroment file

Copy the file `/.env.sample` to `/.env` and configure. \
The `APP_ENV` is about your Development Enviroment. \
If you are in a local enviroment, then set it and the `Ofir`, if not you can set how: `production`, `test`...

**You are ready!**

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
    <b>Name:</b> <?php $user->name;?>
    <b>Email:</b> <?php $user->email;?>
<?php endforeach; ?>
```

### then...

Accessing the url `http://[site.example]/users/`, you will see the all users from you database.

# Changelog:

- [v2.1.1](https://github.com/valdiney/Ofir_Framework-0.1/releases/tag/v2.1.1)
- [v2.1.0](https://github.com/valdiney/Ofir_Framework-0.1/releases/tag/v2.0.0)
- [v1.0.0](https://github.com/valdiney/Ofir_Framework-0.1/releases/tag/v1.0.0) 
