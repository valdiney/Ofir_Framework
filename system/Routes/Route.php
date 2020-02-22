<?php

class Route
{
    public static $controller = null;
    public static $method     = null;
    public static $data       = [];

    public static $view    = null;
    public static $viewDir = 'sources/views/';

    protected static $messages = [
        1 => "The name of the Controller or the name of the Method can be wrong or not exist.",
        2 => "The Controller '%s'  not exist.",
        3 => "The Method '%s' not exist on Controller '%s'.",
    ];

    /**
     * This method is find actual route.
     *
     * @return void
     */
    public static function init() {
        $BRANCH = BRANCH;
        $BRANCH = explode('/', $BRANCH);
        self::configureActualController($BRANCH);
        self::configureActualMethod($BRANCH);
    }

    /**
     * Configure the actual controller from actual that url
     *
     * @param Array $BRANCH
     * @return void
     */
    protected static function configureActualController(Array $BRANCH) {
        $controller = $BRANCH[0];
        $controller = $controller? self::dashesToCamelCase($controller): '';
        if (count($BRANCH)===1 and $BRANCH[0]==='') {
            $controller = "Home";
        }
        $controller = self::verifyControllerExists($controller);
        if ($controller==null and
            !($method = self::verifyIsMethod('HomeController', $BRANCH[0]))) {
            $controller   = "ErrorController";
            self::$method = "controllerNotFound";
        }
        if (isset($method)) {
            array_shift($BRANCH);
            self::$method = $method;
            self::$data = $BRANCH;
            $controller   = 'HomeController';
        }
        self::$controller = $controller;
    }

    /**
     * if class not exists (e.g.: TestController, HomeController...) then class is Home
     *
     * @param string $name
     * @return String
     */
    protected static function verifyControllerExists(String $controller): String {
        $verify = ucwords($controller)."Controller";
        return class_exists($verify)? $verify: '';
    }

    /**
     * Find actual method from the actual url
     *
     * @param Array $BRANCH
     * @return void
     */
    protected static function configureActualMethod(Array $BRANCH) {
        if (self::$method !== null) {
            return;
        }
        # removes the first child
        array_shift($BRANCH);
        # if branch is empty, then the index method is trying to be accessed
        if ($BRANCH==null) {
            array_shift($BRANCH);
            # verify if method index exists
            if ($method = self::verifyIsMethod(self::$controller, 'index')) {
                self::$data = $BRANCH;
                self::$method = $method;
                return;
            }
            # verify if method home exists
            if (($method = self::verifyIsMethod(self::$controller, 'home'))) {
                self::$data = $BRANCH;
                self::$method = $method;
                return;
            }
        }
        if (($method = self::verifyIsMethod(self::$controller, $BRANCH[0]))) {
            array_shift($BRANCH);
            self::$data = $BRANCH;
            self::$method = $method;
            return;
        }
        self::$controller = "ErrorController";
        self::$method     = "methodNotFound";
    }

    /**
     * Verify if method exists in one controller
     *
     * @param String $controller
     * @param String $method
     * @return void
     */
    protected static function verifyIsMethod(String $controller, String $method) {
        $withRequestMethod    = REQUEST_METHOD . self::dashesToCamelCase($method, true);
        $withoutRequestMethod = self::dashesToCamelCase($method);
        if (method_exists($controller, $withRequestMethod)) {
            return $withRequestMethod;
        }
        if (method_exists($controller, $withoutRequestMethod)) {
            return $withoutRequestMethod;
        }
        return null;
    }

    /**
     * Turn an dashed string to camelCase
     *
     * @param String $value
     * @param Bool $capitalizeFirstCharacter
     * @return String
     */
    protected static function dashesToCamelCase(String $value, Bool $capitalizeFirstCharacter=false): String
    {
        $response = str_replace(' ', '', ucwords(str_replace('-', ' ', $value)));
        if (!$capitalizeFirstCharacter) {
            $response[0] = strtolower($response[0]);
        }
        return $response;
    }

    /**
     * Turn camelCase string to an dashed
     *
     * @param String $value
     * @return String
     */
    protected static function camelCaseToDashes(String $value): String
    {
        return strtolower(preg_replace('/([a-zA-Z])(?=[A-Z])/', '$1-', $value));
    }

}
