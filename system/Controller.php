<?php
class Controller
{
	# This methoad load the Library that will be used in the Controller
	protected function library($path, $library_name)
	{
		# Verify if Library Exist
		if (file_exists("library/{$path}/{$library_name}.php")) {

		    $library = "{$library_name}";
		    
            # Include the Library
			require_once("library/{$path}/{$library_name}.php");

			# Instantiante the class Library and passing the Database Connection
			return $library = new $library(Database::connect());
		} else {
			echo "This Library not exist in ( <b>{$path}</b> ) folder.";
			exit();
		}
	}

	protected function view()
	{
		if (file_exists('system/View.php')) {
			require_once('system/View.php');
			return new View();
		}
	}
}