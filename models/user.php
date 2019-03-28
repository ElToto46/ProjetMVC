<?php


class user {
    private $login;
    private $password;
    private $id;
    /* ALT+FN+INSERT*/
    function getLogin() {
        return $this->login;
    }

    function getPassword() {
        return $this->password;
    }
    function getId() {
        return $this->id;
    }

    function setId($id) {
        $this->id = $id;
    }

        function setLogin($login) {
        $this->login = $login;
    }

    function setPassword($password) {
        $this->password = $password;
    }
}
