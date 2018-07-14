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
    protected $layoutName = false;

    # to receive the name of the views that will be used into the layout
    public $content = null;

    protected $includeFiles = array();

    public function importFiles($name)
    {
        if (array_key_exists($name, $this->includeFiles)) {
            return include($this->includeFiles[$name]);
        } else {
            echo "<b>(In View) {$name}</b>: <font color='red'> This file not exist, you should verify the name and path of the file.";
            exit;
        }
    }

    # Return the array of the values that will be used in the views
    protected function getData()
    {
        return $this->data;
    }

    # Receive the name and the path of the layout
    public function layout($layout_name = false)
    {
        $this->layout_name = $layout_name;
    }

    /**
    * Render the view used in the controller
    *
    * @param view_name : string : Name of view and the name of the folder of the view
    * @param data : mixed : Values that will be passed to the view
    */

    public function view($view_name, $data = false)
    {
        if ($data) {
            # Set in array the values passed to view
            foreach ($data as $key => $items) {
                $this->data[$key] = $items;
            }
        }

        # Transforming the operator '.' in operator '='
        $view_name = self::toSlash($view_name);

        # Passing the values to be used into the views
        foreach ($this->getData() as $key => $itens) {
            $$key = $itens;
        }

        # Verify if exist the view file
        if (file_exists("views/{$view_name}.php")) {

            # Passing the name and path of the views files
            $this->content = "views/{$view_name}.php";

            # Verify if the method are using a layout
            if ( ! $this->layout_name == null) {

                # Verify if the layout exist in the layout folder
                if (file_exists("layouts/{$this->layout_name}.php")) {

                    # Include the layout
                    require_once("layouts/{$this->layout_name}.php");

                } else {
                    echo 'This layout not exist in the layout folder';
                }

            } else {
                require_once("views/{$view_name}.php");
            }

        } else {
            echo 'This View not Exist in this folder';
        }
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
