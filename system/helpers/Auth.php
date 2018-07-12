<?php
trait Auth
{
    private function loginVerify($data = array())
    {
        $data['password'] = Hash::make($data['password']);
        $query = $this->db->prepare("SELECT * FROM {$this->table} WHERE login = ? AND password = ?");
        $query->execute(array($data['login'], $data['password']));
        return $query->rowCount();
    }

    public function userExist($data = array())
    {
        if ($this->loginVerify($data)) {
            return true;
        }

        return false;
    }

    public function loginExists($login = false)
    {
        $query = $this->db->prepare("SELECT * FROM {$this->table} WHERE login = ?");
        $query->execute(array($login));
        return $query->rowCount();
    }

    public static function logout()
    {
        session_destroy();
    }

    public function isNotUniqueLogin($login = null, $userIdApplication = null)
    {
        if ($this->loginExist($login)) {

            $userIdFromDatabase = null;

            foreach ($this->privateWhere('login', '=', $login) as $itens) {
                $userIdFromDatabase = $itens->id;
            }

            if ($userIdFromDatabase != $userIdApplication) {
                return true;
            }

            return false;
        }

        return false;
    }

    private function privateWhere($field = null, $condition = null, $value = null)
    {
        $query = $this->db->prepare("SELECT * FROM {$this->table} WHERE {$field} {$condition} ?");
        $query->execute(array($value));
        return $this->fetch($query);
    }
}
