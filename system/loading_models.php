<?php 

/**
* This function is used to get the models in models folder
*
* @return array with the models names
*/

function finding_models()
{
    $model_folder = "models/";
    $dir = dir($model_folder);

    $models = array();
    while ($archives = $dir -> read()) {
        if ($archives != '.' AND $archives != '..') {
            $models[] = $archives;
        }
    }
    
    return $models;
}

/**
* This function is used to include the models in the application
* 
* @param models_name : array : models names
* @return void
*/

function load_models($models_name)
{
    foreach ($models_name as $items) {
        require_once("models/{$items}");
    }
}

# Including the file models
load_models(finding_models());

/**
* Instantiate the models
* 
* @return Array with the models names
*/

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
