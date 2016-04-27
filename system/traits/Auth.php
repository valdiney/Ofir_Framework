<?php 
trait Auth
{
	private function login_verify($data = array())
	{
		$data['password'] = Hash::make($data['password']);
		$query = $this->db->prepare("SELECT * FROM {$this->table} WHERE login = ? AND password = ?");
		$query->execute(array($data['login'], $data['password']));
		return $query->rowCount();
	}

	public function user_exist($data = array())
	{
		if ($this->login_verify($data)) {
			return true;
		}

		return false;
	}

	public function login_exists($login = false)
	{
		$query = $this->db->prepare("SELECT * FROM {$this->table} WHERE login = ?");
		$query->execute(array($login));
		return $query->rowCount();
	}

	public static function logout()
	{
		session_destroy();
	}

	public function is_not_unique_login($login = null, $user_id_application = null)
	{
		if ($this->login_exist($login)) {
			
			$user_id_from_database = null;

			foreach ($this->private_where('login', '=', $login) as $itens) {
				$user_id_from_database = $itens->id;
			}

			if ($user_id_from_database != $user_id_application) {
				return true;
			}

			return false;
		}

		return false;
	}

	private function private_where($field = null, $condition = null, $value = null)
	{
		$query = $this->db->prepare("SELECT * FROM {$this->table} WHERE {$field} {$condition} ?");
		$query->execute(array($value));
		return $this->fetch($query);
	}
}