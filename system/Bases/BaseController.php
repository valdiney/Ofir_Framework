<?php

class BaseController
{

    # This methoad load the Library that will be used in the Controller
    protected function library($path, $libraryName, $usingDB = false) {
        # Verify if Library Exist
        if (file_exists("library/{$path}/{$libraryName}.php")) {

            $library = "{$libraryName}";

            # Include the Library
            require_once("library/{$path}/{$libraryName}.php");

            if ($usingDB) {
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
    protected function model($modelName) {
        # Path of the Model folder
        $path = 'models';

        # Verify if Model Exist
        if (file_exists("{$path}/{$modelName}.php")) {

            $model = "{$modelName}";

            # Include the Model
            require_once("{$path}/{$modelName}.php");

            # Instantiante the class Library and passing the Database Connection
            return $model = new $model(Database::connect());

        } else {
            echo "This Model not exist in ( <b>{$path}</b> ) folder.";
            exit();
        }
    }

	public function finalyze() {
		//
	}

    # to receive the values passed to view
    protected $data = array();

    # to receive the name of the layout that will be used in the controller
    protected $layout = 'default-layout';

    # to receive the name of the views that will be used into the layout
    public $content = null;

    protected $includeFiles = array();

    public function importFiles($name)
    {
        if (array_key_exists($name, $this->includeFiles)) {
            return include($this->includeFiles[$name]);
		}
		echo "<b>(In View) {$name}</b>: <font color='red'> This file not exist, you should verify the name and path of the file.";
		exit;
    }

    # Return the array of the values that will be used in the views
    protected function getData()
    {
        return $this->data;
    }

    # Receive the name and the path of the layout
    public function layout($layout = false)
    {
		$this->layout = $layout;
		return $this;
    }

    /**
    * Render the view used in the controller
    *
    * @param view : string : Name of view and the name of the folder of the view
    * @param data : mixed : Values that will be passed to the view
    */
    public function view($view, $data = false)
    {
        if ($data) {
            # Set in array the values passed to view
            foreach ($data as $key => $items) {
                $this->data[$key] = $items;
            }
		}

        # Transforming the operator '.' in operator '='
		$view = StringHelper::toSlash($view);
		$view = __DIR__ .'/../../'. Route::$viewDir . "{$view}.php";

        # Passing the values to be used into the views
        foreach ($this->getData() as $key => $itens) {
            $$key = $itens;
        }

		# Verify if exist the view file
        if (!file_exists($view)) {
			$view = __DIR__ .'/../../'. Route::$viewDir . "errors/404-page-not-found.php";;
		}

		# Passing the name and path of the views files
		$this->content = $view;

		# Verify if the method are using a layout
		if ($this->layout !== null) {
			$this->layout = __DIR__ ."/../../sources/layouts/{$this->layout}.php";
			# Verify if the layout exist in the layout folder
			if (file_exists($this->layout)) {
				# Include the layout
				$this->content = $view;
				require_once($this->layout);
				exit;
			}
		}
		$view = __DIR__ .'/../../'. Route::$viewDir . "errors/404-page-not-found.php";
		require_once($view);
    }

    public function withFiles($key_word, $name)
    {
        $name = str_replace('.', '/', $name);
        if (file_exists("{$name}.php")) {
            $this->includeFiles[$key_word] = "{$name}.php";
        } else {
            echo "<b>(In Controller) {$name}</b>: <font color='red'> This file not exist, you should verify the name and path of the file";
            exit;
        }
    }
}
