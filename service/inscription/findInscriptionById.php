<?php
if($_SERVER['REQUEST_METHOD'] == 'GET'){
    require_once(__DIR__ . "/../conf/Config.php");
    include("../datasource/connectToBdd.php");

    $mysqli = new mysqli(USE_SERVER_BDD, USE_LOGIN_BDD, USE_PASS_BDD, USE_NAME_BDD);

    $idInscription = $_GET['idInscription'];

    if($idInscription == null){
        print(json_encode("le paramètre 'idInscription' est obligatoire"));
        return;
    }


    // vérification de l'existence de l'inscription en bdd
    $findSql="select * from inscription where id='$idInscription'";
    $result2 = $mysqli->query($findSql);
    $danaInBdd = $result2->fetch_assoc();
    if($danaInBdd["id"] == $idInscription) {
        header('Content-Type: application/json');
        header('idInscription:'. $idInscription);
        print(json_encode($danaInBdd));
    } else {
        print(json_encode("Cette inscription n'existe pas en BDD"));
    }







}

