<?php
if($_SERVER['REQUEST_METHOD'] == 'GET'){
    require_once(__DIR__ . "/../conf/Config.php");
    include("../datasource/connectToBdd.php");

    $mysqli = new mysqli(USE_SERVER_BDD, USE_LOGIN_BDD, USE_PASS_BDD, USE_NAME_BDD);

    // vérification de l'existence de l'inscription en bdd
    $findSql="select * from parent";
    $result2 = $mysqli->query($findSql);
    while($row=$result2->fetch_assoc()){
        $output[]=$row;
    }
    header('Content-Type: application/json');
    print(json_encode($output));

    /* Fermeture de la connexion */
    $mysqli->close();





}

