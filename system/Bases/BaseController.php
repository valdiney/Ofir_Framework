<?php

class BaseController
{

    # to receive the values passed to view
    protected $data = array();

    # to receive the name of the layout that will be used in the controller
    protected $masterLayout = 'default';

    # to receive the name of the views that will be used into the layout
    public $content = null;

    protected $includeFiles = array();

    # This methoad load the Library that will be used in the Controller
    protected function library(String $library, Bool $usingDB=false) {
        # Verify if Library Exist
        if (class_exists($library)) {
            if ($usingDB) {
                # Instantiante the class Library and passing the Database Connection
                return $library = new $library(Database::connect());
            }

            # Instantiante the class Library without passing the Database Connection
            return $library = new $library();
        }
        echo "This Library not exist in ( <b>{$path}</b> ) folder.";
        exit();
    }

    # This methoad load the Model that will be used in the Controller
    protected function model(String $model) {
        # Verify if Model Exist
        if (class_exists($model)) {
            # Instantiante the class Library and passing the Database Connection
            return new $model(Database::connect());
        }
        echo "The Model `{$model}` not exists!";
        exit();
    }

    public function importFiles($name) {
        if (array_key_exists($name, $this->includeFiles)) {
            return include($this->includeFiles[$name]);
        }
        echo "<b>(In View) {$name}</b>: <font color='red'> This file not exist, you should verify the name and path of the file.";
        exit;
    }

    # Return the array of the values that will be used in the views
    protected function getData() {
        return $this->data;
    }

    # Receive the name and the path of the layout
    public function layout($layout = false) {
        $this->masterLayout = $layout;
        return $this;
    }

    /**
    * Render the view used in the controller
    *
    * @param view : string : Name of view and the name of the folder of the view
    * @param data : array : Values that will be passed to the view
    */
    public function view(String $view, Array $data=[]) {
        # Set in array the values passed to view
        foreach ($data as $key => $items) {
            $this->data[$key] = $items;
        }

        # Transforming the operator '.' in operator '='
        $view = StringHelper::toSlash($view);
        $this->content = __DIR__ . "/../../sources/views/{$view}.php";

        # Verify if exist the view file
        if (!file_exists($this->content)) {
            $this->content = __DIR__ . "/../../sources/views/errors/404-page-not-found.php";;
        }
        return $this->render();
    }

    public function withFiles($key_word, $name) {
        $name = str_replace('.', '/', $name);
        if (file_exists("{$name}.php")) {
            $this->includeFiles[$key_word] = "{$name}.php";
        } else {
            echo "<b>(In Controller) {$name}</b>: <font color='red'> This file not exist, you should verify the name and path of the file";
            exit;
        }
    }

    /**
     * Render the actual view
     *
     * @return void
     */
    protected function render() {
        # extracting all data variables
        extract($this->data);
        # Verify if the method are using a layout
        if ($this->masterLayout==null) {
            require_once($this->content);
            exit();
        }
        $this->masterLayout = __DIR__ ."/../../sources/layouts/{$this->masterLayout}/layout.php";
        # Verify if the layout exist in the layout folder
        if (file_exists($this->masterLayout)) {
            require_once($this->masterLayout);
            exit();
        }
        throw new Exception("The layout `$this->masterLayout` doesn't exists.");
    }
}
