<?php 
require_once dirname(__DIR__) . '../system/traits/Input.php';
require_once dirname(__DIR__) . '../system/traits/Helper.php';

class Model extends Persistence
{
	use Input,
	Helper;
}