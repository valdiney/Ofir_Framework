<?php
/**
* This trait is used to work session in the system
* @author Valdiney França <valdiney.2@hotmail.com>
* @version 0.1
*/

trait Session
{ 
	/**
    * --------------------------------------------------------------------------
    * Methods about session
    * --------------------------------------------------------------------------
    */

	public static function start()
	{
		session_start();
	}

	public static function put_session($name = null, $value = null)
	{
		$_SESSION[$name] = $value;
	}

	public static function has_session($name = null)
	{
		if (isset($_SESSION[$name])) {
			return true;
		}

		return false;
	}

	public static function get_session($name = null)
	{
		if (isset($_SESSION[$name])) {
			 return $_SESSION[$name];	
		}

		return false;
	}

	public static function destroy($name = null)
	{
		unset($_SESSION[$name]);
	}

	

	/**
    * --------------------------------------------------------------------------
    * Methods about flash message
    * --------------------------------------------------------------------------
    */

	public static function flash($name = null, $value = null)
	{   
		$key = 'flash_' . $name;
		$_SESSION[$key] = $value;
	}

	public static function has_flash($name = null)
	{
		$name = 'flash_' . $name;
		if (isset($_SESSION[$name])) {
			return true;
		}

		return false;
	}

	public static function get_flash($name = null)
	{
		$name = 'flash_' . $name;
		if (isset($_SESSION[$name])) {
			echo $_SESSION[$name];
			unset($_SESSION[$name]);
		}

		return false;
	}
}
