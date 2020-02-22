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
        $data       = Route::$data;
        try {
            $controller = new $controller;
            if (count($data)) {
                call_user_func_array([$controller, $method], $data);
                return;
            }
            $controller->{$method}();
        } catch(Exception $e) {
            ob_start();
            echo $e->getMessage();
            exit;
        }
    }
}
