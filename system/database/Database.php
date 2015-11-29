<?php 
require_once('Database_config.php');
/**
* --------------------------------------------------------------------------
* This class is used to make the connection with the database
* --------------------------------------------------------------------------
* @var $pdo : Object : Stored the instance of PDO
*/

class Database
{
    use database_config;
    private static $pdo;
    
    public static function connect()
    {
        self::database_config_attributes();

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
                    echo "This Localhost not exist";
                } elseif ($e->getCode() == 1049) {
                    echo "This Database not exist";
                } elseif ($e->getCode() == 1044) {
                    echo "This Username not exist";
                } elseif ($e->getCode() == 1045) {
                    echo "Database Password are incorrect";
                }
            }
        }

        return self::$pdo;
    }
}