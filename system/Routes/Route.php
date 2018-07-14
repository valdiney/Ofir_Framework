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
		var_dump(BRANCH);
	}

}
