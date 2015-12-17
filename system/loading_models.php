<?php 

function finding_models()
{
    $model_folder = "models/";
    $dir = dir($model_folder);

    $models = array();
    while ($archives = $dir -> read()) {
        $models[] = $archives;
        unset($models[0]);
        unset($models[1]);
    }
    
    $dir -> close();
    
    return $models;
}

function load_models()
{
    foreach (finding_models() as $items) {
        require_once("models/{$items}");
    }
}

load_models();

function prepare_models_to_instantiate()
{
    $models = array();
    foreach (finding_models() as $items) {
        $items = explode('.php', $items);
        $models[] = $items[0];
    }

    $models_names = array();
    foreach ($models as $items) {
        $models_names[$items] = new $items(Database::connect());
    }

    return $models_names;
}        