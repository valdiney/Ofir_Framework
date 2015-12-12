<?php 
require_once dirname(__DIR__) . '../system/traits/Input.php';
require_once dirname(__DIR__) . '../system/traits/Helper.php';
require_once dirname(__DIR__) . '../system/traits/Auth.php';
require_once dirname(__DIR__) . '../system/traits/Hash.php';
require_once dirname(__DIR__) . '../system/traits/Redirect.php';
require_once dirname(__DIR__) . '../system/traits/Session.php';

class Model extends Persistence
{
	use Input,
	Helper,
	Auth,
	Hash,
	Redirect,
	Session;
}