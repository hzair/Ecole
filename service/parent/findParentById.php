<?php
if($_SERVER['REQUEST_METHOD'] == 'GET'){
    require_once(__DIR__ . "/../conf/Config.php");
    include("../datasource/connectToBdd.php");

    $mysqli = new mysqli(USE_SERVER_BDD, USE_LOGIN_BDD, USE_PASS_BDD, USE_NAME_BDD);

    $idParent = $_GET['idParent'];

    if($idParent == null){
        print(json_encode("le paramètre 'idParent' est obligatoire"));
        return;
    }


    // vérification de l'existence de l'inscription en bdd
    $findSql="select * from parent where id='$idParent'";
    $result2 = $mysqli->query($findSql);
    $danaInBdd = $result2->fetch_assoc();
    if($danaInBdd["id"] == $idParent) {
        header('Content-Type: application/json');
        header('idParent:'. $idParent);
        print(json_encode($danaInBdd));
    } else {
        print(json_encode("Cette eleve avec ID=".$idParent." n'existe pas en BDD"));
    }







}

