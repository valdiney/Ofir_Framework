## How to install the Ofir Framework

You need to know before that the Ofir has been constructed with some amazing technologies, for provide to you a experience in PHP like a lot of applications and Frameworks amazing. We tryed to made a simple and powerful PHP Framework.

### The Web Environment

So, to install it, you need a `Web Environment`.\
You can work with `Apache` or `Nginx` for example.

#### Apache

For a `Apache Environment`, all that you need to do is configure the `Apache` to point to the `public folder`.

For example, if you created a virtual server, you need to create a point like:

```
<VirtualHost *:80>
    # ...
    DocumentRoot /path/to/project/public
    # ...
</VirtualHost>
```

#### Nginx

For a `Nginx Environment` you need to create a file in `Nginx` configurate directory.

For example, if your `Nginx` has in: `/etc/nginx/`, then you need to create a conf file...

```
sudo su # enter your password
touch /etc/nginx/sites-available/my-virtual-server.local.conf
nano /etc/nginx/sites-available/my-virtual-server.local.conf
ln -s /etc/nginx/sites-available/my-virtual-server.local.conf /etc/nginx/sites-enabled/my-virtual-server.local.conf
nano /etc/nginx/sites-available/my-virtual-server.local.conf
```

Then, put these lines in `/etc/nginx/sites-available/my-virtual-server.local.conf`:

```
server {
    listen 80;
    root [path/to/your/project]/[name-of-your-project]/public;
    index index.php index.html index.htm;
    server_name [name-of-your-project].local www.[name-of-your-project].local;
    charset utf-8;
    location / {
        try_files $uri $uri/ /index.php$is_args$query_string;
    }
    location ~ \.php$ {
		include snippets/fastcgi-php.conf;
        include fastcgi_params;
		fastcgi_pass unix:/run/php/php7.2-fpm.sock;
	}
    location ~/\.ht {
        deny all;
    }
}
```

> Don't forgetting that configure the necessaries names and values!

#### Virtual server

After creates the virtual server in `Apache` and `Nginx`, put the name of the virtual server in your `host file`. Something like:

```
127.0.0.1    localhost
127.0.0.1    [name-of-your-project].local
...
```

### Installing the depencencies

The next step that you need to do is install the `composer` in your machine, case you no have it yet.

#### composer

Go to [composer website](https://getcomposer.org) and choose one option. If you are using [Linux / Unix / OSX](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx), or [Windows](https://getcomposer.org/doc/00-intro.md#installation-windows).

#### getting this project

* You can download this project in a [zip file](https://github.com/valdiney/Ofir_Framework-0.1/archive/master.zip).
* You can clone this repo.
* Or you can `fork this project`.
  * Enjoy to help us :wink:

#### cloning this project from GitHub

Download this project:

> git clone https://github.com/valdiney/Ofir_Framework-0.1 ofir

Then, put:

> cd ofir # go to the ofir directory\
> composer install # install all Ofir dependencies from composer

### environment

`Ofir` uses a file called `.env` to provide a full experience in web development. It will help you when you will have two or more servers to administrate the same project.

For example, if you have a project in a production server, and a other in a test server, then all you need to do is configurate individualy the file `.env` in each server. You will copy all files to theses two servers, then copy the file `.env.sample` to `.env`, on the two ones.\
Then you configure the two ones files `.env` (in each server), to provide the necessaries configs to `Ofir`.

For now the file `.env` looks like:

```
APP_ENV=local
TIMEZONE=America/Sao_Paulo

HOST_NAME=localhost
HOST_USERNAME=root
HOST_PASSWORD=admin
HOST_DBNAME=ofir
```

All that you need to do is change the values for a other that you need.

In case that you need to more explain about the `.env` file, you can read our explain of this in [env-file](https://github.com/valdiney/Ofir_Framework-0.1/tree/master/docs/env-file.md).

### development environment

The `APP_ENV` is about your `Development Enviroment`. \
If you are in a local environment set it, if not you can set like: `production`, `test`...\
You can see more about this file in [env-file](https://github.com/valdiney/Ofir_Framework-0.1/tree/master/docs/env-file.md).
## It's all from now!

Well, I think that it's all and you is ready to init your `Ofir Development`! :smiley:
