<?php 
class Private_areas
{
	public static $Private_areas = false;
	public static $status = false;

	private static function utils($option)
	{
		$url = $_SERVER['REQUEST_URI'];
        $separator = explode('?', $url);
        $other_separator = explode('=', $separator[1]);
        $controller_name = $other_separator[0];
        $method_name = $other_separator[1];

        if ($option == 'method') {
        	$only_name = explode('&', $method_name);
        	return $only_name[0];
        }

        if ($option == 'controller') {
        	return $controller_name;
        }
	}

	public static function private_methods($names)
	{
		foreach ($names as $itens) {
			if ($itens == self::utils('method')) {
				self::$status = true;
			}
		}

		return new self;
	}

	public static function private_controllers($names)
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
			self::$Private_areas .= header("Location:?{$path}");
		}

		return new self;
	}
}