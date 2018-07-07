<?php 
/**
* This trait used to work with string transforming
*/

trait StringHelper
{
	/**
	* Transforming the operator '.' in operator '='
	*
	* @param value : string : String that will be transformed
	* @return string
	*/
	
	public static function toSlash($value = false)
    {
        return str_replace('.', '/', $value);
    }
}