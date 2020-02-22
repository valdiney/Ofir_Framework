<?php

class Controller
{
    protected $controllerPath = 'sources/controllers';
    protected $helper = 'Helpers/Controller.php';

    public function run(string $name)
    {
        $controller = "{$name}Controller";
        $path = "{$this->controllerPath}/{$controller}.php";
        $fullPath = __DIR__ . "/../../../{$path}";
        $content = file_get_contents(__DIR__."/{$this->helper}");
        //
        $view = strtolower($name);
        $content = str_replace('ControllerName', $controller, $content);
        $content = str_replace('home.home', "{$view}.home", $content);
        file_put_contents($fullPath, $content);
        //
        echo "\nCreating controller {$name} in {$path} \n";
    }
}
