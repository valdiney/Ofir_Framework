<?php

namespace Ofir\Routes;

class Route
{
	protected $controller = null;
	protected $method     = null;

	protected $viewNotFound = 'views/erros/404-page-not-found.php';

	protected $messages = [
		1 => "The name of the Controller or the name of the Method can be wrong or not exist.",
		2 => "The Controller '%s'  not exist.",
		3 => "The Method '%s' not exist on Controller '%s'.",
	];

	/**
	 * This method is find actual route.
	 *
	 * @return void
	 */
	public static function init() {}

}
