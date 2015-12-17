<?php 

/**
* This trait is used to Redirect the page 
*
* @param path : string : Name of the controller and name of the method of the controller
* @param vareables : mixed : Name of the variable and values of the variables via HTTP-GET
* @return url of the destination page
*/

trait Redirect
{
	public function to($path = false, $variables = false)
	{
		$path = str_replace(".", "=", $path);
		$complete_path = Generating_perfect_url::generating_perfect_url($path, $variables);
		header("Location:?{$complete_path}&p=1");
	}
}