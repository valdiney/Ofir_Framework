<?php

class Core
{
    /**
     * Initializing the Core of Ofir.
     * That class get the actual route and
     * initialize the controller and the method founded.
     *
     * @return void
     */
    public static function init() {
        $controller = Route::$controller;
        $method     = Route::$method;
        $controller = new $controller;
        $controller->{$method}();
        $controller->finalyze();
    }
}
