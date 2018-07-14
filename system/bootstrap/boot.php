<?php

require_once("config-display-erros.php");

# includes the file responsible for load .env file
require_once("enviroments.php");

# includes the file resposible for define initial consts
require_once("defines.php");

# init the Routing
Route::init();

# Path to pages not fould (404)
$notFoundPath = 'views/page-not-found/404.php';

# Verify if exist a Controller for render the index page
if (array_key_exists(1, $separator))
{
    $theControllerName = explode('=', $separator[1]);
    $controller = ucwords($theControllerName[0]);
    $controllerFirstName = "{$controller}";

    # Verify if exist Controller or Method in the url
    if (array_key_exists(1, $theControllerName)) {

        $methodNameOnly = $theControllerName[1] .= '&';
        $methodNameOnly = explode('&', $methodNameOnly);
        $realMethodName = $methodNameOnly[0];

    } else {
        $massage404 = 'The name of the Controller or the name of the Method can be wrong or not exist';
        require_once($notFoundPath);
        exit;
    }
}
else
{
    # Include the start application file
    require_once('start-application.php');
    $startApplicationBy = str_replace('.', '=', $startApplicationBy);

    if ( ! empty($startApplicationBy)) {
        # Redirect to the first Controller
        header("Location:?{$startApplicationBy}&p=1");
    } else {
        # Redirect to the first Controller
        header("Location:?home=index&p=1");
    }

    $massage404 = 'This Controller not exist';
    require_once($notFoundPath);
    exit;
}

# Verify if Controller exist in the folder 'controllers'
if (file_exists("controllers/{$controllerFirstName}Controller.php"))
{
    # Include Database Config
    require_once('database/DatabaseConfig.php');

    # Include the Database Class
    require_once("system/database/Database.php");

    # Include the Persistence Class
    require_once("system/Persistence.php");

    # Include the Model Class
    require_once("system/Model.php");

    # Include the Controller Class
    require_once("system/Controller.php");

    # Include the Controller that will be called in the url
    require_once("controllers/{$controllerFirstName}Controller.php");

    # full name of controller
    $fullNameController = "{$controllerFirstName}Controller";

    # Including Class for loader Model class and Services in controller
    require_once('system/ClassLoader.php');

    # Model Instantiate
    $modelLoader = new ClassLoader();
    $modelLoader->setDirClass('models/');

    # Service Instantiate
    $serviceLoader = new ClassLoader();
    $serviceLoader->setDirClass('service/');

    # Controller Instantiate
    $controllerApp = new $fullNameController($modelLoader->prepareClassToInstantiate(), $serviceLoader->prepareClassToInstantiate());

    # Start the Session
    Session::start();

    # Include private areas file
    require_once('private-areas.php');

    # Verify if the Method exist in the Class controller
    if (method_exists($controllerApp, $realMethodName)) {

        # Call the methods of the controllers
        $controllerApp->$realMethodName();

    } else {
        $massage404 = 'This method not exist in this Controller';
        require_once($notFoundPath);
        exit;
    }
} else {
    $massage404 = 'This Controller not exist in this application';
    require_once($notFoundPath);
    exit;
}
