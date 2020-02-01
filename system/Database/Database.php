<?php

use Illuminate\Database\Capsule\Manager as Capsule;

/**
* --------------------------------------------------------------------------
* This class is used to make the connection with the database
* --------------------------------------------------------------------------
* @var $pdo : Object : Stored the instance of PDO
*/

class Database 
{
    function __construct() 
    {
        $capsule = new Capsule;

        $capsule->addConnection([
            'driver' => getenv('DB_CONNECTION'),
            'host' => getenv('HOST_NAME'),
            'database' => getenv('HOST_DBNAME'),
            'username' => getenv('HOST_USERNAME'),
            'password' => getenv('HOST_PASSWORD'),
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => '',
        ], "default");

        // Setup the Eloquent ORM… 
        $capsule->bootEloquent();
    }
}