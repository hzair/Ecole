<?php
if($_SERVER['REQUEST_METHOD'] == 'GET'){
    require_once(__DIR__ . "/../conf/Config.php");
    include("../datasource/connectToBdd.php");

    $mysqli = new mysqli(USE_SERVER_BDD, USE_LOGIN_BDD, USE_PASS_BDD, USE_NAME_BDD);

    $email = $_GET['email'];

    if($email == null){
        print(json_encode("le paramètre 'email' est obligatoire"));
        return;
    }


    // vérification de l'existence de l'inscription en bdd
    $findSql="select * from inscription where email=enco'$email'";
    $result = $mysqli->query($findSql);
    while($row=$result->fetch_assoc()){
        $output[]=$row;
    }
    header('Content-Type: application/json');
    if($output != null) {
        print(json_encode($output));
    } else {
        print(json_encode("Aucune inscription avec cet email : ". $email));
    }







}

