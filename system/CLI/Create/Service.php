<?php

class Service
{
    protected $servicePath = 'sources/services';
    protected $helper = 'Helpers/Service.php';

    public function run(string $name)
    {
        $path = "{$this->servicePath}/{$name}.php";
        $fullPath = __DIR__ . "/../../../{$path}";
        $content = file_get_contents(__DIR__."/{$this->helper}");
        //
        $view = strtolower($name);
        $content = str_replace('ServiceName', $name, $content);
        file_put_contents($fullPath, $content);
        //
        echo "\nCreating service {$name} in {$path} \n";
    }
}
