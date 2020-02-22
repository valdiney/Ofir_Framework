<?php

class Create
{

    public function help()
    {
        echo "ofir create [command] [options?] \n";
        echo "  - use this to create controllers, services etc \n\n";
        echo "Examples: \n";
        echo "  - ofir create controller ControllerName\n";
        echo "  - ofir create service    ServiceName\n";
        echo "  - ofir create model      modelname\n";
        exit;
    }

    public function __call(string $name, $args)
    {
        $class = ucfirst($name);
        $path = __DIR__ . "/{$class}.php";
        if (!file_exists($path)) {
            echo "Ops! Method `{$name}` doesn't exists.";
            exit;
        }
        require $path;
        $class = new $class;
        call_user_func_array([$class, 'run'], $args);
    }

}
