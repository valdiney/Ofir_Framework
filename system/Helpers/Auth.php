<?php

class Auth
{
    protected static $sessionName = 'auth_login';

    private function login(String $login, String $password): Int {
        $password = Hash::make($password);
        $query = $this->db->prepare("SELECT * FROM {$this->table} WHERE login = ? AND password = ?");
        $query->execute(array($login, $password));
        return $query->rowCount();
    }

    public function exists(String $login): Bool {
        $query = $this->db->prepare("SELECT * FROM {$this->table} WHERE login = ?");
        $query->execute(array($login));
        return $query->rowCount();
    }

    public static function logout() {
        Session::destroy(self::$sessionName);
    }

    public function isNotUniqueLogin(String $login, Id $userIdApplication) {
        if (!$this->loginExist($login)) {
            return false;
        }
        $userIdFromDatabase = null;
        foreach ($this->privateWhere('login', '=', $login) as $itens) {
            $userIdFromDatabase = $itens->id;
        }
        return $userIdFromDatabase != $userIdApplication;
    }

    private function privateWhere(String $field, String $condition, $value) {
        $query = $this->db->prepare("SELECT * FROM {$this->table} WHERE {$field} {$condition} ?");
        $query->execute(array($value));
        return $this->fetch($query);
    }
}
