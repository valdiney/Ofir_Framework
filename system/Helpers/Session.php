<?php
/**
* This class is used to work session in the system
* @author Valdiney França <valdiney.2@hotmail.com>
* @version 0.1
*/

class Session
{

    /**
     * Put a value in Session
     *
     * @param String $name
     * @param String $value
     * @return void
     */
    public static function put(String $name, String $value) {
        $_SESSION[$name] = $value;
    }

    public static function has(String $name) {
        return isset($_SESSION[$name]);
    }

    public static function get(String $name) {
        return isset($_SESSION[$name])? $_SESSION[$name]: null;
    }

    public static function destroy(String $name) {
        unset($_SESSION[$name]);
    }

    public static function getAndDestroy(String $name) {
        $value = self::get($name);
        self::destroy($_SESSION[$name]);
        return $value;
    }

}
