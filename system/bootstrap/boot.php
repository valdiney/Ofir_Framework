<?php

$URI         = $_SERVER['REQUEST_URI'];
$documentURI = $_SERVER['DOCUMENT_URI'];

# remove ? and # from URI
$URI = preg_replace('/(.*)\?(.*)/', "$1", $URI);
$URI = preg_replace('/(.*)\#(.*)/', "$1", $URI);

# remove index.php fromt DOCUMENT_URI
$documentURI = dirname($documentURI, 1);

# removes the first part from URI.
# that part is the folder before public
# if the DOCUMENT_URI is not '/', in others words,
# if the DOCUMENT_URI is not empty
if ($documentURI!=='/') {
	$URI = str_replace($documentURI, '', $URI);
}
# removes the first bar
$URI = trim($URI, '/');

echo '<pre>';

# get the actual SCRIPT_FILENAME (e.g.: /home/.../site/public/index.php)
# and removes public/index.php from get path to this project
$PATH  = $_SERVER['SCRIPT_FILENAME'];
$PATH  = dirname($PATH, 2);
$PATH .= "/";

#
$SCHEME = $_SERVER['REQUEST_SCHEME'];

# lowered method
$METHOD = strtolower($_SERVER['REQUEST_METHOD']);

# get actual url
$BASE = "{$SCHEME}://{$_SERVER['SERVER_NAME']}{$documentURI}";
# adds a final bar if not contains
if ($BASE[strlen($BASE)-1] !== '/') {
	$BASE .= "/";
}

# Branch is the URI with dots
$BRANCH = str_replace('/', '.', $URI);

# this is the url base of this project
define('BASE',   $BASE);

# this is the PATH to this project
define('PATH', $PATH);

# this is the scheme of the project: http, https...
define('SCHEME', $SCHEME);

# this is the method of the project: get, post, put...
define('METHOD', $METHOD);

# this is the branch that someone is tryng to access:
# users, users/test, about...
# empty branch is like home route
define('BRANCH', $BRANCH);


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
