<?php

/**
 * This classe returns an url based in a route ou a string
 */
class URL
{
    /**
     * Get a route url.
     * If has passed like: "my.route.name", will be transformed in: "my/route/name"
     * @param String $route
     * @return String
     */
    public static function route(String $route): String {
        $route = str_replace('.', '/', $route);
        return self::to($route);
    }

    /**
     * Returns te url with base.
     * @param String $url
     * @return String
     */
    public static function to(String $url): String {
        $url = $url[0]!=='/'? $url: substr($url, 1, strlen($url));
        return BASE . $url;
    }

}
