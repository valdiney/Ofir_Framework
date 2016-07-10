<?php 
$url = $_SERVER['REQUEST_URI'];
$separator = explode('?', $url);

# Path to pages not fould (404)
$not_found_path = 'views/page_not_found/404.php';

# Verify if exist a Controller for render the index page
if (array_key_exists(1, $separator)) 
{
    $the_controller_name = explode('=', $separator[1]);
    $controller = ucwords($the_controller_name[0]);
    $controller_first_name = "{$controller}";
    
    # Verify if exist Controller or Method in the url
    if (array_key_exists(1, $the_controller_name)) {

         $method_name_only = $the_controller_name[1] .= '&';
         $method_name_only = explode('&', $method_name_only);
         $real_method_name = $method_name_only[0]; 

    } else {
        $massage_404 = 'The name of the Controller or the name of the Method can be wrong or not exist';
        require_once($not_found_path);
        exit;
    }
}
else 
{   
    # Include the start application file
    require_once('start_application.php');
    $start_application_by = str_replace('.', '=', $start_application_by);

    if ( ! empty($start_application_by)) {
        # Redirect to the first Controller
        header("Location:?{$start_application_by}&p=1");
    } else {
        # Redirect to the first Controller
        header("Location:?home=index&p=1");
    }

    $massage_404 = 'This Controller not exist';
    require_once($not_found_path);
    exit;
}

# Verify if Controller exist in the folder 'controllers'
if (file_exists("controllers/{$controller_first_name}_Controller.php"))
{
    # Include Database Config
    require_once('database/Database_config.php');

    # Include the Database Class
    require_once("system/database/Database.php");
    
    # Include the Persistence Class
    require_once("system/Persistence.php");

    # Include the Model Class
    require_once("system/Model.php");

    # Include the Controller Class
    require_once("system/Controller.php");

    # Include the Controller that will be called in the url
    require_once("controllers/{$controller_first_name}_Controller.php");
    
    # full name of controller
    $full_name_controller = "{$controller_first_name}_Controller";
    
    # Including Class for loader Model class and Services in controller
    require_once('system/Class_Loader.php');
    
    # Model Instantiate
    $model_loader = new Class_Loader();
    $model_loader->set_dir_class('models/');
    
    # Service Instantiate
    $service_loader = new Class_Loader();
    $service_loader->set_dir_class('service/');
    
    # Controller Instantiate
    $controller_app = new $full_name_controller($model_loader->prepare_class_to_instantiate(), $service_loader->prepare_class_to_instantiate());
    
    # Start the Session
    Session::start();
    
    # Include private areas file
    require_once('private_areas.php');
    
    # Verify if the Method exist in the Class controller
    if (method_exists($controller_app, $real_method_name)) {

        # Call the methods of the controllers
        $controller_app->$real_method_name();

    } else {
        $massage_404 = 'This method not exist in this Controller';
        require_once($not_found_path);
        exit;
    }
} else {
    $massage_404 = 'This Controller not exist in this application';
    require_once($not_found_path);
    exit;
}