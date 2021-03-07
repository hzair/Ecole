<?php
$serveur_ = 'localhost:3306';
$login_ = 'ecole';
$motdepasse_ = 'ecole';
$nom_base_ = 'ecole';


//connexion au serveur
$connexion_ = mysqli_connect($serveur_, $login_, $motdepasse_);
if (!$connexion_){
    die('Non connect&eacute; ::: <br> ' . mysqli_error());
}
else {
    //connexion a la base de donnees
    $bd_ = $connexion_->select_db($nom_base_);
    if (!$bd_) {
        echo "  erreur de connexion a la base de donnees '" . $nom_base_ . "' echoue <br>";
    } else {
        $mysqli = new mysqli($serveur_, $login_, $motdepasse_, $nom_base_);

        return $mysqli;
    }

}
?>
