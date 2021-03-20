<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    require_once(__DIR__ . "/conf/Config.php");
    require_once(__DIR__ . "/../utils/fonctions.php");
    include("/datasource/connectToBdd.php");

    session_start();

    $mysqli = new mysqli(USE_SERVER_BDD, USE_LOGIN_BDD, USE_PASS_BDD, USE_NAME_BDD);

    $success_page = $_POST['returnPage'];
    $err_page = $_POST['returnErrorPage'];
    $idInscription = $_POST['idInscription'];
    $idFoncInscription = $_POST['idFoncInscription'];

    $nom = $_POST['nomEleve'];
    $prenom = $_POST['prenomEleve'];
    $dateNaissance = $_POST['dateNaissEleve']; // format : yyyy-mm-jj
    $lieuNaissance = $_POST['lieuNaissEleve'];
    $sexe = $_POST['sexeEleve'];
    $coursAnneePrec = $_POST['suiviCourEleve'];
    $coursAnneePrecIci = $_POST['suiviCourIciEleve'];
    $numAnneePrecIci = $_POST['numClasseEleve'];
    $autorisationPhoto = $_POST['photographieEleve'];
    $decharge = $_POST['dechargeEleve'];

    $paramObligatoire = null;
    if ($nom == null) $paramObligatoire = "nom";
    if ($prenom == null) $paramObligatoire = $paramObligatoire ." prenom";
    if ($dateNaissance == null) $paramObligatoire = $paramObligatoire ." dateNaissance(ex:yyyy-mm-jj)";
    if ($lieuNaissance == null) $paramObligatoire = $paramObligatoire ." lieuNaissance";
    if ($sexe == null) $paramObligatoire = $paramObligatoire ." sexe";
    if ($idFoncInscription == null) $paramObligatoire = $paramObligatoire ." idFoncInscription";
    if ($coursAnneePrec == null) $paramObligatoire = $paramObligatoire ." coursAnneePrec";
    if ($coursAnneePrec == "1" && $coursAnneePrecIci == null) $paramObligatoire = $paramObligatoire ." coursAnneePrecIci";
    if ($coursAnneePrecIci == "1"  && $numAnneePrecIci == null) $paramObligatoire = $paramObligatoire ." numAnneePrecIci";
    if ($autorisationPhoto == null) $paramObligatoire = $paramObligatoire ." autorisationPhoto";
    if ($decharge == null) $paramObligatoire = $paramObligatoire ." decharge";
    if ($paramObligatoire != null){
        //print(json_encode("les paramettres suivants sont obligatoires : " . $paramObligatoire));
        $_SESSION['messageError'] = "les paramettres suivants sont obligatoires : " . $paramObligatoire;
        header('Location: /'. USE_BASE_URL . $err_page);
        exit;
    }

    // vérification de l'existence de l'inscription en bdd
    if($idInscription == null){
        $findSql="select id from inscription where id_fonc='$idFoncInscription'";
    } else {
        $findSql="select id from inscription where id='$idInscription' and id_fonc='$idFoncInscription'";
    }
    $result2 = $mysqli->query($findSql);
    $dataInBdd = $result2->fetch_array();
    if($dataInBdd["id"] == null) {
        print(json_encode("Erreur de creation eleve : l'inscription avec le numero " . $idFoncInscription . "n'existe pas"));
        $_SESSION['messageError'] = "Erreur de creation eleve : l'inscription avec le numero " . $idFoncInscription . "n'existe pas";
        $_SESSION['idFoncInscriptionInconnu'] = "l'identifiant ". $idFoncInscription . " est inconnu";
        header('Location: /'. USE_BASE_URL . $err_page);
        exit;
    } else {
        $idInscription = $dataInBdd["id"];
    }

    $sql = "INSERT INTO `eleve` (`nom`, `prenom`, `date_naissance`, `lieu_naissance`, `sexe`, `id_inscription`, `cours_annee_prec`, `cours_annee_prec_ici`, `autorisation_photo`, `num_annee_prec_ici`, `decharge`) 
                VALUES ('$nom', '$prenom', '$dateNaissance', '$lieuNaissance', '$sexe', '$idInscription', '$coursAnneePrec', '$coursAnneePrecIci', '$autorisationPhoto', '$numAnneePrecIci', '$decharge')";

    $result = $mysqli->query($sql, MYSQLI_STORE_RESULT_COPY_DATA) ;
    if($result){
        //print(json_encode($result));
        $_SESSION['idInscription'] = $idInscription;
        $_SESSION['idFoncInscription'] = $idFoncInscription;
        unset($_SESSION['messageError']);
        header('Location: /'. USE_BASE_URL . $success_page);
        exit;
    } else {
        print(json_encode("Erreur de creation eleve : " . $mysqli->error));
        header('Location: /'. USE_BASE_URL . $err_page);
    }

    /* Fermeture de la connexion */
    $mysqli->close();



} else {
    print(json_encode("ERREUR : post action "));
    exit;
}

