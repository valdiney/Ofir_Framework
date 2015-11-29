<?php
trait database_config
{
    protected static $host;
    protected static $dbname;
    protected static $username;
    protected static $password;

    public static function database_config_attributes()
    {

        $host = $_SERVER['HTTP_HOST'];

        if ( $host == 'test.com' )
        {
            # Put your credentials of database in production here
            self::$host = null;
            self::$dbname = null;
            self::$username = null;
            self::$password = null;
        }
        elseif ( $host == 'test.com' )
        {
            # Put your credentials of database in production here
            self::$host = null;
            self::$dbname = null;
            self::$username = null;
        }
        else
        {
            # Put your credentials of database localhost here
            self::$host = 'localhost';
            self::$dbname = 'iboulevard';
            self::$username = 'root';
            self::$password = null;
        }
    }
}