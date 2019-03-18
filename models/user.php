<?php


class user {
    private $login;
    private $password;
    /* ALT+FN+INSERT*/
    function getLogin() {
        return $this->login;
    }

    function getPassword() {
        return $this->password;
    }

    function setLogin($login) {
        $this->login = $login;
    }

    function setPassword($password) {
        $this->password = $password;
    }
}
