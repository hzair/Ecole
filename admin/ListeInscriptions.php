<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <title>Liste Inscriptions</title>
</head>
<body>

        <h2>Liste des <span>Inscriptions</span></h2>
        <!--<p>Les champs avec * sont obligatoires </p>-->


<table align="center" border="1" cellpadding="0" cellspacing="1">
    <thead>
    <tr>
        <th  rowspan="2">Action</th>
        <th  rowspan="2">Identifiant</th>
        <th  rowspan="2">Parent</th>
        <th  colspan="3"> Eleve</th>
    </tr>
    <tr>
        <th>Nom</th>
        <th>Prenom</th>
        <th>Sexe</th>
    </tr>
    </thead>
    <tbody>

    <script language="JavaScript" type="text/javascript">

        function modiferInscription(idFonc, id){
            var formElmt = document.getElementById("modif_inscription_form");
            formElmt.idFoncInscription.value = idFonc;
            formElmt.idInscription.value = id;
            formElmt.submit();
        }

        function ficheEngagementPaiementInscription(idFonc, id){
            var formElmt = document.getElementById("fiche_engagement_form");
            formElmt.idFoncInscription.value = idFonc;
            formElmt.idInscription.value = id;
            formElmt.submit();
        }

    </script>

    <form action="majInscriptionAction.php" method="post" id="modif_inscription_form" >
        <INPUT TYPE="hidden" id="idFoncInscription" name="idFoncInscription" value="">
        <INPUT TYPE="hidden" id= "idInscription" name="idInscription" value="">
        <INPUT TYPE='hidden' name='returnPage' value="admin/listeInscriptions.php">
        <INPUT TYPE='hidden' name='returnErrorPage' value="admin/listeInscriptions.php">
    </form>
    <form action="FicheEngagementPaiement.php" method="post" id="fiche_engagement_form" >
        <INPUT TYPE="hidden" id="idFoncInscription" name="idFoncInscription" value="">
        <INPUT TYPE="hidden" id= "idInscription" name="idInscription" value="">
        <INPUT TYPE='hidden' name='returnPage' value="admin/listeInscriptions.php">
        <INPUT TYPE='hidden' name='returnErrorPage' value="admin/listeInscriptions.php">
    </form>

<?php

    require_once(__DIR__ . "/../service/conf/Config.php");
    require_once(__DIR__ . "/../utils/fonctions.php");
    include("../service/datasource/connectToBdd.php");
    session_start();

    $mysqli = new mysqli(USE_SERVER_BDD, USE_LOGIN_BDD, USE_PASS_BDD, USE_NAME_BDD);

    $findAllInscriptionSql = "SELECT * from inscription";
    $listInscription = $mysqli->query($findAllInscriptionSql, MYSQLI_STORE_RESULT_COPY_DATA) ;
    if($listInscription) {
        $i = 0;
        while ($inscription = mysqli_fetch_array($listInscription)) {
            $idInscription = $inscription['id'];
            $idFoncInscription = $inscription['id_fonc'];
            $dateInscription = $inscription['date'];
            // Recuperation Pere
            $findPereSql = "SELECT * FROM parent where id_inscription = '$idInscription' and  sexe= 'M'";
            $PereRes = $mysqli->query($findPereSql, MYSQLI_STORE_RESULT_COPY_DATA) ;
            $pere = $PereRes->fetch_array();
            if($pere) {
                $nomPere = $pere['nom'];
                $prenomPere = $pere['prenom'];
                $portablePere = $pere['telephone_portable'];
            }

            // Recuperation Mere
            $findMereSql = "SELECT * FROM parent where id_inscription = '$idInscription' and  sexe= 'F'";
            $MereRes = $mysqli->query($findMereSql, MYSQLI_STORE_RESULT_COPY_DATA) ;
            $mere = $MereRes->fetch_array();
            if($mere) {
                $nomMere = $mere['nom'];
                $prenomMere = $mere['prenom'];
                $portableMere = $mere['telephone_portable'];
            }


            // Recuperation liste Enfants
            $findEnfantsSql = "SELECT * FROM eleve where id_inscription = '$idInscription'";
            $EleveRes = $mysqli->query($findEnfantsSql, MYSQLI_STORE_RESULT_COPY_DATA) ;

            if($EleveRes) {
                $nbrEleve = 0;
                while($eleve = $EleveRes->fetch_array()) {
                    $sexeEleve = $eleve['sexe'];
                    $prenomEleve = $eleve['prenom'];
                    $nomEleve = $eleve['nom'];
?>
                    <tr>
                        <?php if($nbrEleve == 0) { ?>
                            <th rowspan="<?php echo(getNbrEleves($idInscription, $mysqli));?>">
                               <!--
                                <img src="../ihm/images/icone-modif.png" title="Modifier" alt="Modification" onclick="modiferInscription(<?php echo('\''.$idFoncInscription.'\',\''.$idInscription.'\'');?>);">
                                -->
                                <img src="../ihm/images/fiche_engagement.png" title="Fiche Engagenet" alt="Fiche Engagement et peiement" onclick="ficheEngagementPaiementInscription(<?php echo('\''.$idFoncInscription.'\',\''.$idInscription.'\'');?>);">
                            </th>
                            <th rowspan="<?php echo(getNbrEleves($idInscription, $mysqli));?>">
                                <?php echo($idFoncInscription);?> </th>
                            <td rowspan="<?php echo(getNbrEleves($idInscription, $mysqli));?>">
                                - Mr <?php echo($nomPere." ". $prenomPere." (TEL:" .$portablePere.") <br/>");?>
                                - Mme <?php echo($nomMere." ". $prenomMere." (TEL:" .$portableMere.")");?>
                            </td>
                        <?php } $nbrEleve++; ?>
                         <td><?php echo($nomEleve);?></td>
                         <td><?php echo($prenomEleve);?></td>
                         <td><?php echo($sexeEleve);?></td>
                    </tr>
<?php
                }
                if($nbrEleve == 0) {
                    // TODO : message A Pas d'eleve pour cette inscription
                    ?>
                     <tr>
                         <th rowspan="<?php echo(getNbrEleves($idInscription, $mysqli));?>">
                             <img src="../ihm/images/icone-modif.png" title="Modifier" alt="Modification" onclick="modiferInscription(<?php echo('\''.$idFoncInscription.'\',\''.$idInscription.'\'');?>);">
                             <img src="../ihm/images/fiche_engagement.png" title="Fiche Engagenet" alt="Fiche Engagement" onclick="ficheEngagementPaiementInscription(<?php echo('\''.$idFoncInscription.'\',\''.$idInscription.'\'');?>);">
                         </th>
                        <th rowspan="<?php echo(getNbrEleves($idInscription, $mysqli));?>">
                            <?php echo($idFoncInscription);?> </th>
                        <td rowspan="<?php echo(getNbrEleves($idInscription, $mysqli));?>">
                            - Mr <?php echo($nomPere." ". $prenomPere." (TEL:" .$portablePere.")<br/>");?>
                            - Mme <?php echo($nomMere." ". $prenomMere." (TEL:" .$portableMere.")");?>
                        </td>
                        <td> </td>
                        <td> </td>
                        <td> </td>
                    </tr>
<?php
                }
            }

        }
    } else {
        echo ('Erreur de récupération de la liste des inscriptions : ' . $mysqli->error);
    }


    function getNbrEleves($idInscription, $mysqli) {
        $nbrEnfantsSql = "SELECT count(*) FROM eleve where id_inscription = '$idInscription'";
        $nbrEleveRes = $mysqli->query($nbrEnfantsSql, MYSQLI_STORE_RESULT_COPY_DATA) ;

        if($nbrEleveRes) {
            $nbrEleve = $nbrEleveRes->fetch_array();
            if($nbrEleve) {
                return $nbrEleve['count(*)'];
            }
        }
        return 0;
    }


?>

    </tbody>
</table>

                    </div></div></div></div></div></section>

</body></html>