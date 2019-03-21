<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of dbController
 *
 * @author Ghost
 */
class dbController {
    private $bddserver ='127.0.0.1';
    private $bddname = '';
    private $bdduser = 'root';
    private $bddpassword = '';
    private $bdddriver= '';
    private $bddlink;
    function __construct(){         // APPELE EN PREMIER DANS  L APPEL DE DBCONTROLLER
        $dsn = $this->bdddriver.':dbname='.$this->bdname.';host='.$this->bddserver;
        try {
            $this->bddlink = new PDO($dsn , $this->bdduser, $this->bddpassword);
            $this->bddlink -> setAttribute(PDO::ATR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Connection Failed:' . $e->getMessage();
        }
    }
    
    function getBddserver() {
        return $this->bddserver;
    }

    function getBddname() {
        return $this->bddname;
    }

    function getBdduser() {
        return $this->bdduser;
    }

    function getBddpassword() {
        return $this->bddpassword;
    }
    function getBdddriver() {
        return $this->bdddriver;
    }

    function getBddlink() {
        return $this->bddlink;
    }

    function setBdddriver($bdddriver) {
        $this->bdddriver = $bdddriver;
    }

    function setBddlink($bddlink) {
        $this->bddlink = $bddlink;
    }

        
    function setBddserveur($bddserver) {
        $this->bddserveur = $bddserver;
    }

    function setBddname($bddname) {
        $this->bddname = $bddname;
    }

    function setBdduser($bdduser) {
        $this->bdduser = $bdduser;
    }

    function setBddpassword($bddpassword) {
        $this->bddpassword = $bddpassword;
    }


}
