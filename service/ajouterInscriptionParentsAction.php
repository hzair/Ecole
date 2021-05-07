<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    require_once(__DIR__ . "/conf/Config.php");
    require_once(__DIR__ . "/../utils/fonctions.php");
    include("datasource/connectToBdd.php");

    session_start();

    $mysqli = new mysqli(USE_SERVER_BDD, USE_LOGIN_BDD, USE_PASS_BDD, USE_NAME_BDD);

    $success_page = $_POST['returnPage'];
    $err_page = $_POST['returnErrorPage'];

    /*
    // Vérification de la disponibilite du Email
    $emailMajuscul = $_POST['email'];
    $sqlDispoMail = "SELECT upper(email) FROM inscription where upper(email)=upper('$emailMajuscul')";
    $resultDispoMail = $mysqli->query($sqlDispoMail, MYSQLI_STORE_RESULT_COPY_DATA) ;
    while($dataDispoMail = mysqli_fetch_array($resultDispoMail)){
        if($dataDispoMail['upper(email)'] == $emailMajuscul) {
            $_SESSION['messageError'] = "Email déjà utilisé pour un autre compte. Merci de choisir un autre Email ou se connecter sur votre ancien compte";
            header('Location: /'. USE_BASE_URL . $err_page);
            exit;
        } else {
            $_SESSION['messageError'] = "2 Email déjà utilisé pour un autre compte. Merci de choisir un autre Email ou se connecter sur votre ancien compte";
            header('Location: /'. USE_BASE_URL . $err_page);
            exit;
        }
    }
    */

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

            // Envoyer Email
            envoiEmail($email, creationCompteMessage($nomPere, $idFoncInscr));

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

function envoiEmail($destination, $message) {
    $from = "nepasrepondre@institutespoir.fr";
    $subject = "Inscription : Création Compte Institut Espoir";

    $headers  = 'MIME-Version: 1.0' . "\n"; // Version MIME
    $headers .= 'Reply-To: '.$from."\n"; // Mail de reponse
    $headers .= 'From: "Ecole - Institut Espoir"<'.$from.'>'."\n"; // Expediteur

    mail($destination,$subject,$message, $headers);
}

function creationCompteMessage($nom, $idFoncInsc){
    return "Bonjour Mr, Mme ".$nom. "\n".
        "Votre compte est bien créé. Vous pouvez utiliser votre identifiant ci-dessous pour une autre inscription. \n" .
        "Identifiant d'inscription : ".$idFoncInsc ."\n \n".

        "Pour valider l’inscription vous devez prendre un RDV avec la direction au plus tard le 25/05/2021 en utilisant le lien suivant : \n" .

        "http://rdv.ecole.institutespoir.fr/  \n \n".

        "Pour plus d’informations contacter la direction, en préférence, par SMS ou par Mail : \n".

        "Tel : 0687931689 \n" .

        "Mail : inscriptions.Institutespoir@gmail.com \n \n" .

        "Cordialement \n" .
        "Institut Espoir";
}