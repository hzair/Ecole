<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    require_once(__DIR__ . "/../conf/Config.php");
    include("../datasource/connectToBdd.php");

    $mysqli = new mysqli(USE_SERVER_BDD, USE_LOGIN_BDD, USE_PASS_BDD, USE_NAME_BDD);


    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $dateNaissance = $_POST['dateNaissance']; // format : yyyy-mm-jj
    $lieuNaissance = $_POST['lieuNaissance'];
    $sexe = $_POST['sexe'];
    $idInscription = $_POST['idInscription'];
    $coursAnneePrec = $_POST['coursAnneePrec'];
    $coursAnneePrecIci = $_POST['coursAnneePrecIci'];
    $numAnneePrecIci = $_POST['numAnneePrecIci'];
    $autorisationPhoto = $_POST['autorisationPhoto'];
    $decharge = $_POST['decharge'];

    $paramObligatoire = null;
    if ($nom == null) $paramObligatoire = "nom";
    if ($prenom == null) $paramObligatoire = $paramObligatoire ." prenom";
    if ($dateNaissance == null) $paramObligatoire = $paramObligatoire ." dateNaissance(ex:yyyy-mm-jj)";
    if ($lieuNaissance == null) $paramObligatoire = $paramObligatoire ." lieuNaissance";
    if ($sexe == null) $paramObligatoire = $paramObligatoire ." sexe";
    if ($idInscription == null) $paramObligatoire = $paramObligatoire ." idInscription";
    if ($coursAnneePrec == null) $paramObligatoire = $paramObligatoire ." coursAnneePrec";
    if ($coursAnneePrecIci == null) $paramObligatoire = $paramObligatoire ." coursAnneePrecIci";
    if ($coursAnneePrecIci == "1"  && $numAnneePrecIci == null) $paramObligatoire = $paramObligatoire ." numAnneePrecIci";
    if ($autorisationPhoto == null) $paramObligatoire = $paramObligatoire ." autorisationPhoto";
    if ($decharge == null) $paramObligatoire = $paramObligatoire ." decharge";
    if ($paramObligatoire != null){
        print(json_encode("les paramettres suivants sont obligatoires : " . $paramObligatoire));
        return;
    }

    // vérification de l'existence de l'inscription en bdd
    $findSql="select count(id) from inscription where id='$idInscription'";
    $result2 = $mysqli->query($findSql);
    $danaInBdd = $result2->fetch_array();
    if($danaInBdd["count(id)"] == 0) {
        print(json_encode("Erreur de creation eleve : l'inscription avec le numero " . $idInscription . "n'existe pas"));
        return;
    }

    $sql = "INSERT INTO `eleve` (`nom`, `prenom`, `date_naissance`, `lieu_naissance`, `sexe`, `id_inscription`, `cours_annee_prec`, `cours_annee_prec_ici`, `autorisation_photo`, `num_annee_prec_ici`, `decharge`) 
                VALUES ('$nom', '$prenom', '$dateNaissance', '$lieuNaissance', '$sexe', '$idInscription', '$coursAnneePrec', '$coursAnneePrecIci', '$autorisationPhoto', '$numAnneePrecIci', '$decharge')";

    $result = $mysqli->query($sql, MYSQLI_STORE_RESULT_COPY_DATA) ;
    if($result){
        print(json_encode($result));
    } else {
        print(json_encode("Erreur de creation eleve : " . $mysqli->error));
    }

    /* Fermeture de la connexion */
    $mysqli->close();







}

