<?php

class Flash
{
    protected $key = 'flash_';

    /**
     * Put a valeu in flashed message.
     *
     * @param String $name
     * @param [type] $value
     * @return void
     */
    public static function put(String $name, $value) {
        $key = self::$key . $name;
        Session::put($key, $value);
    }

    /**
     * Verify if flashedmessage exists
     *
     * @param String $name
     * @return boolean
     */
    public static function has(String $name) {
        $name = self::$key . $name;
        return Session::has($name);
    }

    /**
     * Get the flashed message and clear.
     *
     * @param String $name
     * @return void
     */
    public static function get(String $name) {
        $name = self::$key . $name;
        return Session::getAndDestroy($name);
    }
}
