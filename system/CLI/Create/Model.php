<?php

class Model
{
    protected $modelPath = 'sources/models';
    protected $helper = 'Helpers/Model.php';

    public function run(string $name)
    {
        $name = ucfirst($name);
        $model = strtolower($name);
        $path = "{$this->modelPath}/{$name}.php";
        $fullPath = __DIR__ . "/../../../{$path}";
        $content = file_get_contents(__DIR__."/{$this->helper}");
        //
        $view = strtolower($name);
        $content = str_replace('ModelName', $name, $content);
        $content = str_replace('tablename', $model, $content);
        file_put_contents($fullPath, $content);
        //
        echo "\nCreating model {$name} in {$path} \n";
    }
}
