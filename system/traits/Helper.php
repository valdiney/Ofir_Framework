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
		echo "?" . self::generating_perfect_url($path, $variables);
    }
    
    /**
	* Create the help 'action'

	* @param  path : string : name of the controller and name of the method of the controller
    * @param  variables : string : variables and the values of the variables passed via 'HTTP-GET'
    */

    public static function action($path = false, $variables = false)
    {
    	echo 'action="?' . self::generating_perfect_url($path, $variables) . '"';
    }
    
    /**
	* Create a perfect url that can be access the controllers and methods of the controllers
	* like: index.php?user=update&id=1

	* @param  path : string : name of the controller and name of the method of the controller
    * @param  variables : string : variables and the values of the variables passed via 'HTTP-GET'
    */

    public static function generating_perfect_url($path = false, $variables = false)
    {
    	# Transforming the operator '.' in operator '='
		$path = str_replace('.', '=', $path);

		if ($variables) 
		{
			$variables_collection = null;

			# Transforming the String for Array, separate by '|'
			$variables_separator = explode('|', $variables);

			foreach ($variables_separator as $itens) {

				# Transforming Array for String and putting the operator '&' for separate the variables
				$variables_collection .= "&{$itens}";
			}
            
            # Print the path with the variables via 'HTTP-GET'
			return $path . $variables_collection;

		} else {

			# Print the path without variables via 'HTTP-GET'
			return $path;
		}
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
    	$path = str_replace('.', '/', $path);
    	
    	echo "<link rel='stylesheet' href='public/{$path}.css'></style>";
    }
}