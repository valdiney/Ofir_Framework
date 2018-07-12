<?php
/**
* This class is used to work with another way of to access superglobals of the PHP
*/

class Input
{
    /**
    * This method is used to access superglobals $_POST
    *
    * @param input_value : string : Name of the variable via $_POST
    * @return Can return a variable via $_POST or return boolean false
    */
    public static function inPost($input_value = false)
    {
        if (isset($_POST[$input_value])) {
            return $_POST[$input_value];
        }

        return false;
    }

    /**
    * This method is used to access superglobals $_GET
    *
    * @param input_value : string : Name of the variable via $_GET
    * @return Can return a variable via $_GET or return boolean false
    */
    public static function inGet($input_value = false)
    {
        if (isset($_GET[$input_value])) {
            return $_GET[$input_value];
        }

        return false;
    }

    /**
    * This method is used to access superglobals $_FILES
    *
    * @param input_name : string : Name of the variable via $_FILES
    * @param file_name : boolean : If true, return the name of the file
    * @return Can return a variable $_FILES or return boolean false
    */
    public static function inFiles($input_name = false, $file_name = false)
    {
        if ($file_name) {
            return $_FILES[$input_name]['name'];
        }

        if (isset($_FILES[$input_name])) {
            return $_FILES[$input_name];
        }

        return false;
    }
}
