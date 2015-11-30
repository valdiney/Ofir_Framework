<?php 
/**
* This trait used to work with string transforming
*/

trait String_helper
{
	/**
	* Transforming the operator '.' in operator '='
	*
	* @param value : string : String that will be transformed
	* @return string
	*/
	
	public static function to_slash($value = false)
    {
        return str_replace('.', '/', $value);
    }
}