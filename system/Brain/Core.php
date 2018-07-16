<?php

class Core
{
    public static function init() {
        $controller = Route::$controller;
        $method     = Route::$method;
        $controller = new Route::$controller;
        $controller->$method();
        $controller->finalyze();
    }
}
