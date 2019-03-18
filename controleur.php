<?php
//Utilisation variable de session
session_start();
//Chemin racine de l'application
define('PATHROOT',__DIR__);
define('DS',DIRECTORY_SEPARATOR);
define('PATHVIEWS', PATHROOT.DS.'vues'.DS);

$content ='hello projet mvc';

include PATHVIEWS.'page.php';