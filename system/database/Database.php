<?php
/**
* --------------------------------------------------------------------------
* This class is used to make the connection with the database
* --------------------------------------------------------------------------
* @var $pdo : Object : Stored the instance of PDO
*/

class Database
{
    use DatabaseConfig;
    private static $pdo;

    public static function connect()
    {
        self::databaseConfigAttributes();

        if ( ! isset($pdo))
        {
            try
            {
                self::$pdo = new PDO("mysql:" . "host=" . self::$host . ";" . "dbname=" . self::$dbname, self::$username, self::$password,
                    array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            }
            catch (PDOException $e)
            {
                if ($e->getCode() == 2002) {
                    echo "<b>Database configuration Error:</b> This Localhost not exist in this server";
                    exit;
                } elseif ($e->getCode() == 1049) {
                    echo "<b>Database configuration Error:</b> This Database not exist in this server";
                    exit;
                } elseif ($e->getCode() == 1044) {
                    echo "<b>Database configuration Error:</b> Database username not exist in this server";
                    exit;
                } elseif ($e->getCode() == 1045) {
                    echo "<b>Database configuration Error:</b> Database Password are incorrect";
                    exit;
                }
            }
        }

        return self::$pdo;
    }
}
