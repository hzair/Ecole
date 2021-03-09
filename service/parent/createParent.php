<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    require_once(__DIR__ . "/../conf/Config.php");
    include("../datasource/connectToBdd.php");

    $mysqli = new mysqli(USE_SERVER_BDD, USE_LOGIN_BDD, USE_PASS_BDD, USE_NAME_BDD);


    $idInscription = $_POST['idInscription'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $sexe = $_POST['sexe'];
    $telephonePortable = $_POST['telephonePortable'];
    $telephoneFixe = $_POST['telephoneFixe'];
    $profession = $_POST['profession'];
    $adresse = $_POST['adresse'];
    $codePostale = $_POST['codePostale'];
    $ville = $_POST['ville'];
    $email = $_POST['email'];

    $paramObligatoire = null;
    if ($idInscription == null) $paramObligatoire = " idInscription";
    if ($nom == null) $paramObligatoire = $paramObligatoire ."nom";
    if ($prenom == null) $paramObligatoire = $paramObligatoire ." prenom";
    if ($sexe == null) $paramObligatoire = $paramObligatoire ." sexe";
    if ($email == null) $paramObligatoire = $paramObligatoire ." email";
    if ($profession == null) $paramObligatoire = $paramObligatoire ." profession";
    if ($adresse == null) $paramObligatoire = $paramObligatoire ." adresse";
    if ($codePostale == null) $paramObligatoire = $paramObligatoire ." codePostale";
    if ($ville == null) $paramObligatoire = $paramObligatoire ." ville";
    if ($telephoneFixe == null) $paramObligatoire = $paramObligatoire ." telephoneFixe";
    if ($telephonePortable == null) $paramObligatoire = $paramObligatoire ." telephonePortable";
    if ($paramObligatoire != null){
        print(json_encode("les paramettres suivants sont obligatoires : " . $paramObligatoire));
        return;
    }

    // vérification de l'existence de l'inscription en bdd
    $findSql="select count(id) from inscription where id='$idInscription'";
    $result2 = $mysqli->query($findSql);
    $danaInBdd = $result2->fetch_array();
    if($danaInBdd["count(id)"] == 0) {
        print(json_encode("Erreur de creation parent : l'inscription avec le numero " . $idInscription . "n'existe pas"));
        return;
    }

    $sql = "INSERT INTO `parent` (`nom`, `prenom`, `email`, `profession`, `sexe`, `id_inscription`, `adresse`, `code_postale`, `ville`, `telephone_fixe`, `telephone_portable`) 
                VALUES ('$nom', '$prenom', '$email', '$profession', '$sexe', '$idInscription', '$adresse', '$codePostale', '$ville', '$telephoneFixe', '$telephonePortable')";

    $result = $mysqli->query($sql) ;
    if($result){
        print(json_encode($result));
    } else {
        print(json_encode("Erreur de creation parent : " . $mysqli->error));
    }

    /* Fermeture de la connexion */
    $mysqli->close();







}

