<?php
if($_SERVER['REQUEST_METHOD'] == 'GET'){
    include("../datasource/connectToBdd.php");

    $serveur_ = 'localhost:3306';
    $login_ = 'ecole';
    $motdepasse_ = 'ecole';
    $nom_base_ = 'ecole';
    $mysqli = new mysqli($serveur_, $login_, $motdepasse_, $nom_base_);

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

