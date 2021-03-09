<?php

require_once(__DIR__ . "/../conf/Config.php");

//connexion au serveur
$connexion_ = mysqli_connect(USE_SERVER_BDD, USE_LOGIN_BDD, USE_PASS_BDD);
if (!$connexion_){
    die('Non connect&eacute; ::: <br> ' . mysqli_error());
}
else {
    //connexion a la base de donnees
    $bd_ = $connexion_->select_db(USE_NAME_BDD);
    if (!$bd_) {
        echo "  erreur de connexion a la base de donnees '" . USE_NAME_BDD . "' echoue <br>";
    } else {
        $mysqli = new mysqli(USE_SERVER_BDD, USE_LOGIN_BDD, USE_PASS_BDD, USE_NAME_BDD);

        return $mysqli;
    }




}
?>
