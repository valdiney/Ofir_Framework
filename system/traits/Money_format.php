<?php 

/**
* This trait is used to work with money format
*/

trait Money_format
{
	/**
	* Formatting of numbers to Brazil format
	*
	* @param number : number : The number that will be formatted
	* @return : number : Formatted Brazilian number
	*/
	public static function br_format($number)
	{
		return number_format($number, 2, ',', '.');
	}
}