<?php

class CLI
{

    public function help()
    {
        echo "ofir [command] [options?] \n";
        echo "  - use this to create controllers, services etc \n\n";
        echo "Examples: \n";
        echo "  - ofir create [command]\n";
        exit;
    }

    public function __call(string $name, $params)
    {
        $class = ucfirst($name);
        include "{$class}/{$class}.php";
        $Create = new Create;
        $method = $params[0];
        $params = array_slice($params, 1);
        call_user_func_array([$Create, $method], $params);
    }

}
