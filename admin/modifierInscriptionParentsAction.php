<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    require_once(__DIR__ . "/../service/conf/Config.php");
    require_once(__DIR__ . "/../utils/fonctions.php");
    include("../service/datasource/connectToBdd.php");

    session_start();

    $mysqli = new mysqli(USE_SERVER_BDD, USE_LOGIN_BDD, USE_PASS_BDD, USE_NAME_BDD);

    $success_page = $_POST['returnPage'];
    $err_page = $_POST['returnErrorPage'];
    $idFoncInscription = $_POST['idFoncInscription'];
    $idInscription= $_POST['idInscription'];

    $parentsSepare = $_POST['parentsSepare'];

    $sql = "update `inscription` set `parents_separe` = '$parentsSepare' where `id` = '$idInscription'";
    $result = $mysqli->query($sql);
    // =========== PARENTS ===================================================================================

    // Pere :
    $nomPere = $_POST['nomPere'];
    $prenomPere = $_POST['prenomPere'];
    $sexePere = 'M';
    $telephonePortablePere = $_POST['portablePere'];
    $professionPere = $_POST['professionPere'];
    $coursArabeAdultePere = 0;
    $coursSciencesIslamiquesPere = 0;


    // Mere :
    $nomMere = $_POST['nomMere'];
    $prenomMere = $_POST['prenomMere'];
    $sexeMere = 'F';
    $telephonePortableMere = $_POST['portableMere'];
    $professionMere = $_POST['professionMere'];
    $coursArabeAdulteMere = 0;
    $coursSciencesIslamiquesMere = 0;


    $email = $_POST['email'];
    $telephoneFixe = $_POST['telephoneFixe'];
    $adresse = $_POST['adressePostale'];
    $codePostale = $_POST['codePostale'];
    $ville = $_POST['ville'];

    // Modification du PERE en BDD
    $sql = "update `parent` set `nom`='$nomPere', `prenom`='$prenomPere', `email`='$email', `profession`='$professionPere', 
                                  `adresse`='$adresse', `code_postale`='$codePostale', 
                                  `ville`='$ville', `telephone_fixe`='$telephoneFixe', `telephone_portable`='$telephonePortablePere', 
                                  `cours_arabe_adulte`='$coursArabeAdultePere', `cours_sciences_islamiques`='$coursSciencesIslamiquesPere' 
                                   where `id_inscription` = '$idInscription' and `sexe` = 'M'";

    $result = $mysqli->query($sql) ;

    // Creation du MERE en BDD
    $sql2 = "update `parent` set `nom`='$nomMere', `prenom`='$prenomMere', `email`='$email', `profession`='$professionMere', 
                                  `adresse`='$adresse', `code_postale`='$codePostale', 
                                  `ville`='$ville', `telephone_fixe`='$telephoneFixe', `telephone_portable`='$telephonePortableMere', 
                                  `cours_arabe_adulte`='$coursArabeAdulteMere', `cours_sciences_islamiques`='$coursSciencesIslamiquesMere' 
                                   where `id_inscription` = '$idInscription' and `sexe` = 'F'";

        $result2 = $mysqli->query($sql2) ;

            // Redirection de la page
            header('Location: /'. USE_BASE_URL . $success_page);






    /* Fermeture de la connexion */
    $mysqli->close();
} else {
    print(json_encode("ERREUR : post action "));
    exit;
}

