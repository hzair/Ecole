<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once(__DIR__ . "/../service/conf/Config.php");
    require_once(__DIR__ . "/../utils/fonctions.php");
    include("../service/datasource/connectToBdd.php");

    session_start();

    $mysqli = new mysqli(USE_SERVER_BDD, USE_LOGIN_BDD, USE_PASS_BDD, USE_NAME_BDD);

    $success_page = $_POST['returnPage'];
    $err_page = $_POST['returnErrorPage'];
    $idNewInscription = $_POST['idNewInscription'];
    $idEleve = $_POST['idEleve'];


    $paramObligatoire = null;
    if ($idNewInscription == null) $paramObligatoire = " $idNewInscription";
    if ($idEleve == null) $paramObligatoire = $paramObligatoire . " $idEleve";
    if ($paramObligatoire != null) {
        print(json_encode("les paramettres suivants sont obligatoires : " . $paramObligatoire));
        $_SESSION['messageError'] = "les paramettres suivants sont obligatoires : " . $paramObligatoire;
        //header('Location: /' . USE_BASE_URL . $err_page);
        exit;
    }

    // requete de suppression
    $updateEleveSql = "update eleve set id_inscription = '$idNewInscription' where id ='$idEleve'";

    $result = $mysqli->query($updateEleveSql);
    if (!$result) {
        print(json_encode("errr1"));
        $_SESSION['messageError'] = "Erreur de délisteElevesFiltre.phpplacement de l'eleve avec le numero " . $idEleve;
        //header('Location: /' . USE_BASE_URL . $err_page);
        exit;
    }


    /* Fermeture de la connexion */
    $mysqli->close();


    //header('Location: /' . USE_BASE_URL . $success_page);

}

