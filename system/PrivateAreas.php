<?php
class PrivateAreas
{
    public static $privateAreas = false;
    public static $status = false;

    private static function utils($option)
    {
        $url = $_SERVER['REQUEST_URI'];
        $separator = explode('?', $url);
        $otherSeparator = explode('=', $separator[1]);
        $controllerName = $otherSeparator[0];
        $methodName = $otherSeparator[1];

        if ($option == 'method') {
            $onlyName = explode('&', $methodName);
            return $onlyName[0];
        }

        if ($option == 'controller') {
            return $controllerName;
        }
    }

    public static function privateMethods($names)
    {
        foreach ($names as $itens) {
            if ($itens == self::utils('method')) {
                self::$status = true;
            }
        }

        return new self;
    }

    public static function privateControllers($names)
    {
        foreach ($names as $itens) {
            if ($itens == self::utils('controller')) {
                self::$status = true;
            }
        }

        return new self;
    }

    public static function redirect($path)
    {
        $path = str_replace('.', '=', $path);

        if (self::$status) {
            self::$privateAreas .= header("Location:?{$path}");
        }

        return new self;
    }
}
