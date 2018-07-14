<?php
/**
* This trait is used to work with some helpers to the application
*/

class Helper
{
    /**
    * Create the help 'link_to'

    * @param  path : string : name of the controller and name of the method of the controller
    * @param  variables : string : variables and the values of the variables passed via 'HTTP-GET'
    */

    public static function linkTo($path = false, $variables = false)
    {
        echo "href='?" . GeneratingPerfectURL::generatingPerfectURL($path, $variables) . "&p=1" . "'>";
    }

    /**
    * Create the help 'action'

    * @param  path : string : name of the controller and name of the method of the controller
    * @param  variables : string : variables and the values of the variables passed via 'HTTP-GET'
    */

    public static function action($path = false, $variables = false)
    {
        echo 'action="?' . GeneratingPerfectURL::generatingPerfectURL($path, $variables) . '">';
    }


    /**
    * This method is used for include css in the layout
    *
    * @param path : string : The folder and name of the css file
    * @return void
    */

    public static function css($path = false)
    {
        # Transforming the operator '.' in operator '='
        $path = StringHelper::toSlash($path);
        echo "<link rel='stylesheet' href='{$path}.css'></style>";
    }

    /**
    * This method is used for include script in the layout
    *
    * @param path : string : The folder and name of the script file
    * @return void
    */

    public static function script($path = false)
    {
        # Transforming the operator '.' in operator '='
        $path = StringHelper::toSlash($path);
        echo "<script src='{$path}.js'></script>";
    }

    public static function importOnce($path)
    {
        $path = StringHelper::toSlash($path);
        require_once dirname(__DIR__) . "/../{$path}.php";
    }
}
