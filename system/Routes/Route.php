<?php

class Route
{
	protected static $controller = null;
	protected static $method     = null;

	protected static $viewNotFound = 'views/erros/404-page-not-found.php';

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
	}

	/**
	 * Configure the actual controller from actual that url
	 *
	 * @param Array $BRANCH
	 * @return void
	 */
	protected static function configureActualController(Array $BRANCH) {
		$controller = self::dashesToCamelCase($BRANCH[0]);
		if (count($BRANCH)===1 and $BRANCH[0]==='') {
			$controller = 'Home';
		}

		$controller = self::verifyClassExists($controller)? ucfirst($controller): 'Home';
		$controller = "{$controller}Controller";

		var_dump($controller);
	}

	/**
	 * if class not exists (e.g.: TestController, HomeController...) then class is Home
	 *
	 * @param string $name
	 * @return String
	 */
	protected static function verifyClassExists(string $name): String {
		$classVerify = ucwords($controller)."Controller";
		return class_exists($classVerify);
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

}
