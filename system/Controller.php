<?php
class Controller
{
	# This methoad load the Library that will be used in the Controller
	protected function library($path, $library_name, $using_db = false)
	{
		# Verify if Library Exist
		if (file_exists("library/{$path}/{$library_name}.php")) {

		    $library = "{$library_name}";
		    
            # Include the Library
			require_once("library/{$path}/{$library_name}.php");

			if ($using_db) {
				# Instantiante the class Library and passing the Database Connection
			    return $library = new $library(Database::connect());
			}

			# Instantiante the class Library without passing the Database Connection
			return $library = new $library();

		} else {
			echo "This Library not exist in ( <b>{$path}</b> ) folder.";
			exit();
		}
	}

	# This methoad load the Model that will be used in the Controller
	protected function model($model_name)
	{
		# Path of the Model folder
		$path = 'models';

		# Verify if Model Exist
		if (file_exists("{$path}/{$model_name}.php")) {

		    $model = "{$model_name}";
		    
            # Include the Model
			require_once("{$path}/{$model_name}.php");

			# Instantiante the class Library and passing the Database Connection
			return $model = new $model(Database::connect());

		} else {
			echo "This Model not exist in ( <b>{$path}</b> ) folder.";
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