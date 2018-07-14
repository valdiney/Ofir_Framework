<?php

namespace Ofir\Bases;

class BaseController
{
    # This methoad load the Library that will be used in the Controller
    protected function library($path, $libraryName, $usingDB = false)
    {
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
    protected function model($modelName)
    {
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

    protected function view()
    {
        if (file_exists('system/View.php')) {
            require_once('system/View.php');
            return new View();
        }
    }
}
