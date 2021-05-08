<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once(__DIR__ . "/../service/conf/Config.php");
    require_once(__DIR__ . "/../utils/fonctions.php");

    session_start();

    $success_page = $_POST['returnPage'];
    $err_page = $_POST['returnErrorPage'];

    $nomPere = $_POST['nomPere'];
    $email = $_POST['email'];
    //echo ($email. " _ " . $_SESSION['idFoncInscription'] . " - ". $nomPere);
    // Envoyer Email
    envoiEmail_($email, creationCompteMessage($nomPere, $_SESSION['idFoncInscription']));

    $_SESSION['insciptionFinalise'] = $_SESSION['idFoncInscription'];





    // Redirection de la page
   header('Location: /' . USE_BASE_URL . $success_page);

}

function envoiEmail_($destination, $message)
{
    $from = "nepasrepondre@institutespoir.fr";
    $subject = "Inscription : Création Compte Institut Espoir";

    $headers = 'MIME-Version: 1.0' . "\n"; // Version MIME
    $headers .= 'Reply-To: ' . $from . "\n"; // Mail de reponse
    $headers .= 'From: "Ecole - Institut Espoir"<' . $from . '>' . "\n"; // Expediteur

    mail($destination, $subject, $message, $headers);
}

function creationCompteMessage($nom, $idFoncInsc)
{
    return "Bonjour Mr, Mme " . $nom . "\n" .
        "Votre compte est bien créé. Vous pouvez utiliser votre identifiant ci-dessous pour une autre inscription. \n" .
        "Identifiant d'inscription : " . $idFoncInsc . "\n \n" .

        "Pour valider l’inscription vous devez prendre un RDV avec la direction au plus tard le 25/05/2021 en utilisant le lien suivant : \n" .

        "http://rdv.ecole.institutespoir.fr/  \n \n" .

        "Pour plus d’informations contacter la direction, en préférence, par SMS ou par Mail : \n" .

        "Tel : 0687931689 \n" .

        "Mail : inscriptions.Institutespoir@gmail.com \n \n" .

        "Cordialement \n" .
        "Institut Espoir";
}
