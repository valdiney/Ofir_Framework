<?php 

trait Redirect
{
	public function to_route($path = false, $variables = false)
	{
		$path = str_replace(".", "=", $path);
		$complete_path = Generating_perfect_url::generating_perfect_url($path, $variables);
		header("Location:?{$complete_path}");
	}
}