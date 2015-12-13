<?php 
require_once('traits/Input.php');
require_once('traits/Helper.php');
require_once('traits/Auth.php');
require_once('traits/Hash.php');
require_once('traits/Redirect.php');
require_once('traits/Session.php');

class Model extends Persistence
{
	use Input,
	Helper,
	Auth,
	Hash,
	Redirect,
	Session;
}