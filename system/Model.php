<?php 
require_once('traits/StringHelper.php');
require_once('traits/GeneratingPerfectURL.php');
require_once('traits/GetURL.php');

require_once('traits/Input.php');
require_once('traits/Helper.php');
require_once('traits/Auth.php');
require_once('traits/Hash.php');
require_once('traits/Redirect.php');
require_once('traits/Session.php');
require_once('traits/Pagination.php');
require_once('traits/Date.php');
require_once('traits/MoneyFormat.php');

class Model extends Persistence
{
	use Input,
	Helper,
	Auth,
	Hash,
	Redirect,
	Session,
	Pagination,
	GetURL,
	Date,
	MoneyFormat;
}