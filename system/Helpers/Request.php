<?php
/**
* This class is used to work with another way of to access superglobals of the PHP
*/

class Request
{
    /**
    * This method is used to access superglobals $_POST
    *
    * @param input_value : string : Name of the variable via $_POST
    * @return Can return a variable via $_POST or return boolean false
    */
    public static function input($input_value = false) {
        if (isset($_POST[$input_value])) {
            return $_POST[$input_value];
        }

        return false;
    }

    public static function all()
    {
        $data = [];
        foreach ($_POST as $key => $value) {
            $data[$key] = $value;
        }

        return $data;
    }

    public static function only($fields)
    {
        $data = [];
        foreach ($fields as $value) {
            $data[$value] = $_POST[$value];
        }

        return $data;
    }
}
