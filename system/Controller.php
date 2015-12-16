<?php
class Controller
{
	# This methoad load the Model that will be used in the Controller
	protected function load_model($model_name)
	{
		$model_name = str_replace('.', '/', $model_name);
		
		# Verify if Model Exist
		if (file_exists("models/{$model_name}.php")) {
		    $model_path = explode('/', $model_name);
		    $model = $model_path[1];
            
            # Include the Model
			require_once("models/{$model_name}.php");

			# Instantiante the class Model and passing the Database Connection
			return $model = new $model(Database::connect());
		} else {
			echo 'This Model not exist';
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