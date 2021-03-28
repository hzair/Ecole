<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    require_once(dirname(__FILE__) . "/conf/Config.php");
    require_once(dirname(__FILE__) . "/../utils/fonctions.php");
    include("/datasource/connectToBdd.php");

    session_start();

    $mysqli = new mysqli(USE_SERVER_BDD, USE_LOGIN_BDD, USE_PASS_BDD, USE_NAME_BDD);

    $success_page = $_POST['returnPage'];
    $err_page = $_POST['returnErrorPage'];

    // Generer ID fonctionnel d'inscription
    $idFoncInscr = generateAndVerifyIfExistIdFoncInBdd($mysqli);


    $sql = "INSERT INTO `inscription` (`id`, `id_fonc`, `id_pere`, `id_mere`, `date`, `parents_separe`) VALUES (NULL, '$idFoncInscr', NULL, NULL, NOW(), NULL)";
    $result = $mysqli->query($sql);
    if($result){
        $sql2 = "SELECT id FROM inscription where id_fonc = '$idFoncInscr'";
        $result2 = $mysqli->query($sql2);
        $data2 = $result2->fetch_array();
        $idInscription = $data2["id"];
    } else {
        print(json_encode("erreur de creation inscription : " . $mysqli->error));
        return;
    }


    // =========== PARENTS ===================================================================================

    // Pere :
    $nomPere = $_POST['nomPere'];
    $prenomPere = $_POST['prenomPere'];
    $sexePere = 'M';
    $telephonePortablePere = $_POST['portablePere'];
    $professionPere = $_POST['professionPere'];
    $coursAdultPere = $_POST['coursAdultPere'];
    if($coursAdultPere == 'coursLesDeux'){
        $coursArabeAdultePere = 1;
        $coursSciencesIslamiquesPere = 1;
    } else if($coursAdultPere == 'coursArabeAdulte') {
        $coursArabeAdultePere = 1;
        $coursSciencesIslamiquesPere = 0;
    } else if($coursAdultPere == 'coursSciencesIslamiques') {
        $coursArabeAdultePere = 0;
        $coursSciencesIslamiquesPere = 1;
    } else {
        $coursArabeAdultePere = 0;
        $coursSciencesIslamiquesPere = 0;
    }

    // Mere :
    $nomMere = $_POST['nomMere'];
    $prenomMere = $_POST['prenomMere'];
    $sexeMere = 'F';
    $telephonePortableMere = $_POST['portableMere'];
    $professionMere = $_POST['professionMere'];
    $coursAdultMere = $_POST['coursAdultMere'];
    if($coursAdultMere == 'coursLesDeux'){
        $coursArabeAdulteMere = 1;
        $coursSciencesIslamiquesMere = 1;
    } else if($coursAdultMere == 'coursArabeAdulte') {
        $coursArabeAdulteMere = 1;
        $coursSciencesIslamiquesMere = 0;
    } else if($coursAdultMere == 'coursSciencesIslamiques') {
        $coursArabeAdulteMere = 0;
        $coursSciencesIslamiquesMere = 1;
    } else {
        $coursArabeAdulteMere = 0;
        $coursSciencesIslamiquesMere = 0;
    }

    $parentsSepare = $_POST['parentsSepare'];
    $email = $_POST['email'];
    $telephoneFixe = $_POST['telephoneFixe'];
    $adresse = $_POST['adressePostale'];
    $codePostale = $_POST['codePostale'];
    $ville = $_POST['ville'];

    $paramObligatoire = null;
    if ($idInscription == null) $paramObligatoire = " idInscription";
    if ($nomPere == null) $paramObligatoire = $paramObligatoire ." nomPere";
    if ($prenomPere == null) $paramObligatoire = $paramObligatoire ." prenomPere";
    //if ($professionPere == null) $paramObligatoire = $paramObligatoire ." professionPere";
    if ($telephonePortablePere == null) $paramObligatoire = $paramObligatoire ." telephonePortablePere";
    if ($nomMere == null) $paramObligatoire = $paramObligatoire ." nomMere";
    if ($prenomMere == null) $paramObligatoire = $paramObligatoire ." prenomMere";
    //if ($professionMere == null) $paramObligatoire = $paramObligatoire ." professionMere";
    //if ($telephonePortableMere == null) $paramObligatoire = $paramObligatoire ." telephonePortableMere";
    if ($email == null) $paramObligatoire = $paramObligatoire ." email";
    if ($adresse == null) $paramObligatoire = $paramObligatoire ." adressePostale";
    if ($codePostale == null) $paramObligatoire = $paramObligatoire ." codePostale";
    if ($ville == null) $paramObligatoire = $paramObligatoire ." ville";
    //if ($telephoneFixe == null) $paramObligatoire = $paramObligatoire ." telephoneFixe";
    if ($paramObligatoire != null){
        print(json_encode("les paramettres suivants sont obligatoires : " . $paramObligatoire));
        $_SESSION['messageError'] = "les paramettres suivants sont obligatoires : " . $paramObligatoire;
        header('Location: /'. USE_BASE_URL . $err_page);
        exit;
    }


    // Creation du PERE en BDD
    $sql = "INSERT INTO `parent` (`nom`, `prenom`, `email`, `profession`, `sexe`,
                                  `id_inscription`, `adresse`, `code_postale`, 
                                  `ville`, `telephone_fixe`, `telephone_portable`, 
                                  `cours_arabe_adulte`, `cours_sciences_islamiques`) 
                VALUES ('$nomPere', '$prenomPere', '$email', '$professionPere', 'M', 
                        '$idInscription', '$adresse', '$codePostale', '$ville',
                        '$telephoneFixe', '$telephonePortablePere',
                        '$coursArabeAdultePere', '$coursSciencesIslamiquesPere')";

    $result = $mysqli->query($sql) ;
    if($result){
        // Creation du MERE en BDD
        $sql2 = "INSERT INTO `parent` (`nom`, `prenom`, `email`, `profession`, `sexe`,
                                       `id_inscription`, `adresse`, `code_postale`,
                                       `ville`, `telephone_fixe`, `telephone_portable`,
                                        `cours_arabe_adulte`, `cours_sciences_islamiques`) 
                VALUES ('$nomMere', '$prenomMere', '$email', '$professionMere', 'F',
                        '$idInscription', '$adresse', '$codePostale', '$ville',
                        '$telephoneFixe', '$telephonePortableMere',
                        '$coursArabeAdulteMere', '$coursSciencesIslamiquesMere')";

        $result2 = $mysqli->query($sql2) ;
        if ($result2) {
            unset($_SESSION['messageError']);
            $_SESSION['idInscription'] = $idInscription;
            $_SESSION['idFoncInscription'] = $idFoncInscr;
            // Redirection de la page
            header('Location: /'. USE_BASE_URL . $success_page);
        } else {
            $_SESSION['messageError'] = "Erreur de creation du mere en bdd : " . $mysqli->error;
            header('Location: /'. USE_BASE_URL . $err_page);
        }
    } else {
        $_SESSION['messageError'] = "Erreur de creation du pere : " . $mysqli->error;
        //print(json_encode("Erreur de creation du pere : " . $mysqli->error));
    }




    /* Fermeture de la connexion */
    $mysqli->close();
} else {
    print(json_encode("ERREUR : post action "));
    exit;
}

function generateAndVerifyIfExistIdFoncInBdd($mysqli){
    $idFoncInscr = '2021' . chaine_aleatoire(3, 'azertyiopqsdfghjklmwxcvbn')
        . chaine_aleatoire(3, '0123456789');
    // verifier si $idFonc existe deja en bdd
    $existReq = "SELECT id FROM inscription where id_fonc = '$idFoncInscr'";
    $result = $mysqli->query($existReq);
    $data = $result->fetch_array();
    if($data["id"]){
        return generateAndVerifyIfExistIdFoncInBdd($mysqli);
    } else {
        return $idFoncInscr;
    }
}