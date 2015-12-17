<?php 
/**
* This trait is used to work with some helpers to the application
*/

trait Helper
{
	/**
	* Create the help 'link_to'

	* @param  path : string : name of the controller and name of the method of the controller
    * @param  variables : string : variables and the values of the variables passed via 'HTTP-GET'
    */

	public static function link_to($path = false, $variables = false)
	{
		echo "href='?" . Generating_perfect_url::generating_perfect_url($path, $variables) . "&p=1" . "'>";
    }
    
    /**
	* Create the help 'action'

	* @param  path : string : name of the controller and name of the method of the controller
    * @param  variables : string : variables and the values of the variables passed via 'HTTP-GET'
    */

    public static function action($path = false, $variables = false)
    {
    	echo 'action="?' . Generating_perfect_url::generating_perfect_url($path, $variables) . '">';
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
        $path = String_helper::to_slash($path);
    	echo "<link rel='stylesheet' href='public/{$path}.css'></style>";
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
        $path = String_helper::to_slash($path);
        echo "<script src='public/{$path}.js'></script>";
    }

    public static function import_once($path)
    {
        $path = String_helper::to_slash($path);
        require_once dirname(__DIR__) . "/../{$path}.php";
    }
}