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
class dbController extends configController{
    private $bddserver ='127.0.0.1';
    private $bddname = '';
    private $bdduser = 'root';
    private $bddpassword = '';
    private $bdddriver= '';
    private $bddlink;
    
    
    function __construct(){ 
        parent::__construct();
        $config = parent :: getConfigParameter('dbConfig');
foreach ($config as $key=>$value){
    $method = 'set'.ucfirst($key);
    if(method_exists($this,$method)){
    $this->$method($value);
}
}
        $dsn = $this->bdddriver.':dbname='.$this->bddname.';host='.$this->bddserver;
        try {
            $this->bddlink = new PDO($dsn , $this->bdduser, $this->bddpassword);
            $this->bddlink -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
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
    
    
    
    
        function findOneBy(object $objet ,array $options=array()){ // $options est un paramètre
        try{
               $table=get_class($objet);  //récupère la classe de mon objet
               $champs= '*';
        if(isset($options['champs']) && !empty($options)){
        $champs = implode(',',$options['champs']);
        }
        if(!isset($options['criteria'])){
            throw new Exception(__METHOD__.' '.__LINE__.': criteria doit être défini');
        }
        $query = ' SELECT ' .$champs.' FROM '.$table.' WHERE ';
        $nbCriteria = count(array_keys($options['criteria']));
        $keys = array_keys($options['criteria']);
        
        for($i=0; $i<$nbCriteria; $i++){
            if($i>0){
                $query .= ' AND ';
            }
        $query .= $keys[$i].' = :'.$keys[$i];
        }
        $query .=' LIMIT 1 ';
        $req = $this->bddlink->prepare($query);
        $req -> execute($options['criteria']);
        
        $result = $req->fetch(PDO::FETCH_ASSOC);     //fetch et pas fetch_all car un seul enregirstrement à récup
        return $result;
        }
        catch (Exception $ex){
            echo $ex->getMessage();
            return array();
            }
        }
        function findOneById(object $object,$id){
            return $this->findOneBy($object,
                    array('criteria' 
                        => array('id'=>$id)
                        ));
            //Penser à retourner un objet hehe
        }
}