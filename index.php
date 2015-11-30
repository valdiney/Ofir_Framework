<?php 
$url = $_SERVER['REQUEST_URI'];
$separator = explode('?', $url);

# Verify if exist a Controller for render the index page
if (array_key_exists(1, $separator)) 
{
    $the_controller_name = explode('=', $separator[1]);
    $controller = ucwords($the_controller_name[0]);
    $complete_name_controller = "{$controller}_controller.php";

    $method_name_only = $the_controller_name[1] .= '&';
    $method_name_only = explode('&', $method_name_only);
    $real_method_name = $method_name_only[0];  
}
else 
{
    # Search for the 'home' Controller and 'method' 'index'
	$controller_name = '?home=index';

	# Redirect to the first Controller
	header("Location:{$controller_name}");

	echo 'This Controller not exist';
	exit;
}

# Verify if Controller exist in the folder 'controllers'
if (file_exists("controllers/{$complete_name_controller}"))
{
	# Include the Database Class
    require_once('system/database/Database.php');
    
    # Include the Persistence Class
    require_once("system/Persistence.php");

    # Include the Model Class
	require_once("system/Model.php");

	# Include the Controller Class
	require_once("system/Controller.php");

    # Include the View Class
	require_once("system/View.php");
    
    # Include the Controller that will be called in the url
	require_once("controllers/{$complete_name_controller}");
    
    # Instantiante the class Controller
    $controller_app = new $controller();

    # Verify if the Method exist in the Class controller
    if (method_exists($controller_app, $real_method_name)) {

        # Call the methods of the controllers
    	$controller_app->$real_method_name();

    } else {
    	echo 'This method not exist in this class';
    }
} else {
	echo 'This Contoller not exist in this application';
}