<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    include("../datasource/connectToBdd.php");

    $serveur_ = 'localhost:3306';
    $login_ = 'ecole';
    $motdepasse_ = 'ecole';
    $nom_base_ = 'ecole';
    $mysqli = new mysqli($serveur_, $login_, $motdepasse_, $nom_base_);

    $idParent = $_POST['idParent'];
    if ($idParent == null){
        print(json_encode("le paramettre suivant est obligatoire : idParent"));
        return;
    }

    //$idInscription = $_POST['idInscription'];
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

    // Verifier si Parent existe en BDD
    $findSql="select * from parent where id='$idParent'";
    $result2 = $mysqli->query($findSql);
    $dataInBdd = $result2->fetch_array();
    if($dataInBdd["id"] == $idParent) {
        $paramObligatoire = null;
        //if ($idInscription == null) $idInscription = $dataInBdd["id_inscription"];
        if ($nom == null) $nom = $dataInBdd["nom"];
        if ($prenom == null) $prenom = $dataInBdd["prenom"];
        if ($email == null) $email = $dataInBdd["email"];
        if ($profession == null) $profession = $dataInBdd["profession"];
        if ($sexe == null) $sexe = $dataInBdd["sexe"];
        if ($adresse == null) $adresse = $dataInBdd["adresse"];
        if ($codePostale == null) $codePostale = $dataInBdd["code_postale"];
        if ($ville == null) $ville = $dataInBdd["ville"];
        if ($telephoneFixe == null) $telephoneFixe = $dataInBdd["telephone_fixe"];
        if ($telephonePortable == null) $telephonePortable = $dataInBdd["telephone_portable"];

        $sql = "UPDATE parent SET nom='$nom', prenom='$prenom', email='$email', profession='$profession', 
                sexe='$sexe', adresse='$adresse', code_postale='$codePostale', ville='$ville', 
                telephone_fixe='$telephoneFixe', telephone_portable='$telephonePortable'
                WHERE id=$idParent";

        $result = $mysqli->query($sql, MYSQLI_STORE_RESULT_COPY_DATA);
        if ($result) {
            print(json_encode($result));
        } else {
            print(json_encode("Erreur de mise a jour parent : " . $mysqli->error));
        }

    } else {
        print(json_encode("Erreur de mise a jour : le parent avec ID=".$idParent." n'existe pas" ));
    }

    /* Fermeture de la connexion */
    $mysqli->close();



}

