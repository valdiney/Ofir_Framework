<?php 

# Register the name of your class service in this array
service_loader(array());

/*
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

    return $models;
}

function load_models()
{
	foreach ($models as $items) {
    	require_once("models/{$items}");
    }
}

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

   $models = array();
   foreach ($get_model as $items) {
    $items = explode('.php', $items);
    $models[] = $items[0];
   }
   
   $models_name = array();
   foreach ($models as $key => $items) {
     $models_name[$items] = new $items(Database::connect());
   }
   */