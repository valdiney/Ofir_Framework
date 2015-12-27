<?php 

/**
* This function is used to get the services in services folder
*
* @return array with the services names
*/

function finding_services()
{
    $service_folder = "service/";
    $dir = dir($service_folder);

    $services = array();
    while ($archives = $dir -> read()) {
        if ($archives != '.' AND $archives != '..') {
            $services[] = $archives;
        }
    }
    
    return $services;
}

/**
* This function is used to include the services in the application
* 
* @param models_services : array : services names
* @return void
*/

function load_service($service_name)
{
    foreach ($service_name as $items) {
        require_once("service/{$items}");
    }
}

# Including the file services
load_service(finding_services());

/**
* Instantiate the services
* 
* @return Array with the services names
*/

function prepare_service_to_instantiate()
{
    $services = array();
    foreach (finding_services() as $items) {
        $items = explode('.php', $items);
        $services[] = $items[0];
    }

    $services_names = array();
    foreach ($services as $items) {
        $services_names[$items] = new $items();
    }

    return $services_names;
}        