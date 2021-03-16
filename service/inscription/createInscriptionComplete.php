<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    require_once(__DIR__ . "/../conf/Config.php");
    include("../datasource/connectToBdd.php");


    $body = file_get_contents('php://input');
    //print("body : " . $body);

    $inscription = json_decode($body);
    $email = $inscription->email;
    $telephoneFixe = $inscription->{"telephoneFixe"};
    $parents_separe = $inscription->{"parents_separe"};
    $adresse = $inscription->{"adresse "};
    $codePostale = $inscription->{"codePostale"};
    $ville = $inscription->{"ville"};

    // Information du pere
    $pere = $inscription->{"pere"};
    if($pere != null) {

    }

    // Information du mere
    $mere = $inscription->{"mere"};
    if($mere != null) {

    }

    // information des enfant
    $enfants = $inscription->{"enfants"};
    $nbrEnfant = count($enfants);
    foreach($enfants as $i => $enfant){

        print(" \n i : " . $i);


    }










}

