<?php 

trait GetURL
{
    public static function getURL($option)
    {
        $url = $_SERVER['REQUEST_URI'];
        $separator = explode('?', $url);
        $other_separator = explode('=', $separator[1]);
        $controller_name = $other_separator[0];
        $method_name = $other_separator[1];

        if ($option == 'method') {
            return $method_name;
        }

        if ($option == 'controller') {
            return $controller_name;
        }
    }
}