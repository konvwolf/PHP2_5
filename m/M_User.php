<?php
class M_User {
    private $sql;
    function __construct() {
        $this->sql = new C_DataBase();
    }
    function userRegister($name, $login, $password) {
        $query = $this->sql->insertIntoDB('user', 'name, login, password', '\''.$name.'\', \''.$login.'\', \''.password_hash($password, PASSWORD_DEFAULT).'\'');
        if ($query != 0) {
            return true;
        }
    }

    function userLogin($login) {
        $pass = $this->sql->selectFromDB('password', 'user', 'WHERE login=\''.$login.'\'');
        if (password_verify ($_POST['password'], $pass[0]['password'])) {
            return true;
        }
    }
}