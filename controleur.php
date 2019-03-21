<?php
//Utilisation variable de session
session_start();
//Chemin racine de l'application
define('PATHROOT',__DIR__);
//Determine / ou \
define('DS',DIRECTORY_SEPARATOR);
//Récupération de la page demandée en URL
define('PATHVIEWS', PATHROOT.DS.'vues'.DS); /// vers les vues.

//Constante vers les controlleurs
define('PATHCTRL', PATHROOT.DS.'controllers'.DS);

define('PATHMDL', PATHROOT.DS.'models'.DS); //Constant du chemin vers mes entités.

// Récupérer les fichiers de configuration
$config = yaml_parse_file(PATHROOT.DS.'conf'.DS.'parameters.yml');

//include PATHMDL.'user.php';   // avant pck si on a pas mis en premier la classe user , la suite ne sera pas valide
//include PATHCTRL.'userController.php'; // des controleurs qui se trouvent dans user.php , il va venir charger automatiquement la classe user ( donc les méthodes comprises)
//include PATHCTRL.'dbController.php';    //charge automatiquement la page dbController.php

    function autoLoadModel($modelName){
        if(file_exists(PATHMDL.$modelName.'.php')){
            require_once PATHMDL.$modelName.'.php';
        }
    }
    function autoLoadController($controllerName){
        if(file_exists(PATHCTRL.$controllerName.'.php')){
            require_once PATHCTRL.$controllerName.'.php';
        }
    }
    
    spl_autoload_register('autoLoadModel');
        spl_autoload_register('autoLoadController');
    
    
    
//$oBdd = new dbController($config['dbConfig']); 

$page = filter_input(INPUT_GET, 'page' , FILTER_SANITIZE_STRING);

//récup d'une action
$action=filter_input(INPUT_GET,'action',FILTER_SANITIZE_STRING);
    if(!is_null($action)){
        //Récupère la chaine demandée et la découpe pour récupérer le controleur et la méthode
        //user-login
        $tabAction= explode('-',$action);            //explode créé directement un tableau
            $controller = $tabAction[0].'Controller';
            //récup de la méthode à éxecuter
                $method = $tabAction[1].'Action';
              //Instanciation de l'objet
                $objet = new $controller();
               //Appel de la méthode 
                $resAction = $objet->$method();
                if($resAction) {
                    $page=$resAction;
                               }
                         }
//test si une page est demandée sinon affiche la page par défaut
//vérifie également si la vue existe
    if(is_null($page)|| !file_exists(PATHVIEWS.$page.'.php')){
        $page = 'acceuil';
                                                             }
//affiche la vue
include PATHVIEWS.'page.php';