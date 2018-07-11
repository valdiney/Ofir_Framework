<?php
trait DatabaseConfig
{
    protected static $host;
    protected static $dbname;
    protected static $username;
    protected static $password;

    public static function databaseConfigAttributes()
    {
        $host = $_SERVER['HTTP_HOST'];

        if ( $host == 'your_domain.com' ) {
            # Put your credentials of database in production here
            self::$host = null;
            self::$dbname = null;
            self::$username = null;
            self::$password = null; 
        } else {
            # Put your credentials of database localhost here
            self::$host = null;
            self::$dbname = null;
            self::$username = null;
            self::$password = null;
        }
    }
}
