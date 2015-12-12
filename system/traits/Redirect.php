<?php 
trait Redirect
{
	public function to_route($path = false)
	{
		$path = str_replace(".", "=", $path);
		header("Location:?{$path}");
	}
}