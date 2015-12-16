<?php 

trait Generating_perfect_url
{
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

		if ($variables) {
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
}