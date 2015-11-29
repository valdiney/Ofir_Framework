<?php 
class User extends Model
{
	protected $table = 'usuario';

	public function listar()
	{
		$data = array(1,2,3,4,5,6,7,8,9,10);
		return $data;
	}
}