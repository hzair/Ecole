<html lang="en" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
<?php

    require_once(__DIR__ . "/../service/conf/Config.php");
    require_once(__DIR__ . "/../utils/fonctions.php");
    include("../service/datasource/connectToBdd.php");
    session_start();
 ?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LISTE INSCRIPTIONS </title>

    <link rel="stylesheet" href="../ihm/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="../ihm/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="../ihm/css/animate.css"/>

    <link rel="stylesheet" href="../ihm/css/style.css" />

    <script type="text/javascript" src="../ihm/js/jquery-1.11.2.min.js"></script>
    <script type="text/javascript" src="../ihm/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCZXJBVDf7R4JqmSpopVPoduIGWx1IwpBM"></script>
    <script type="text/javascript" src="../ihm/js/plugins.js"></script>

    <!-- Insérer cette balise "link" après celle de Bootstrap -->
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.16.0/dist/bootstrap-table.min.css">

    <!-- Insérer cette balise "script" après celle de Bootstrap -->
    <script src="https://unpkg.com/bootstrap-table@1.16.0/dist/bootstrap-table.min.js"></script>
    <script src="https://unpkg.com/bootstrap-table@1.16.0/dist/locale/bootstrap-table-fr-FR.min.js"></script>

    <link rel="stylesheet" type="text/css" href="extensions/filter-control/bootstrap-table-filter-control.css">
    <script src="extensions/filter-control/bootstrap-table-filter-control.js"></script>


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->


    <script type="application/javascript">
    </script>
</head>
<body>

<script language="JavaScript" type="text/javascript">

    function supprimerInscription(idFonc, id){
        if(confirm("Voulez-vous supprimer définitivement cette inscription avec l'identifiant '" + idFonc + "' ?")) {
            var formElmt = document.getElementById("supp_inscription_form");
            formElmt.idFoncInscription.value = idFonc;
            formElmt.idInscription.value = id;
            formElmt.submit();
        }
    }

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

<form action="deleteInscriptionAction.php" method="post" id="supp_inscription_form" >
    <INPUT TYPE="hidden" id="idFoncInscription" name="idFoncInscription" value="">
    <INPUT TYPE="hidden" id= "idInscription" name="idInscription" value="">
    <INPUT TYPE='hidden' name='returnPage' value="admin/listeInscriptionsFiltre.php">
    <INPUT TYPE='hidden' name='returnErrorPage' value="admin/listeInscriptionsFiltre.php">
</form>
<form action="majInscriptionAction.php" method="post" id="modif_inscription_form" >
    <INPUT TYPE="hidden" id="idFoncInscription" name="idFoncInscription" value="">
    <INPUT TYPE="hidden" id= "idInscription" name="idInscription" value="">
    <INPUT TYPE='hidden' name='returnPage' value="admin/listeInscriptionsFiltre.php">
    <INPUT TYPE='hidden' name='returnErrorPage' value="admin/listeInscriptionsFiltre.php">
</form>
<form action="FicheEngagementPaiement.php" method="post" id="fiche_engagement_form" >
    <INPUT TYPE="hidden" id="idFoncInscription" name="idFoncInscription" value="">
    <INPUT TYPE="hidden" id= "idInscription" name="idInscription" value="">
    <INPUT TYPE='hidden' name='returnPage' value="admin/listeInscriptionsFiltre.php">
    <INPUT TYPE='hidden' name='returnErrorPage' value="admin/listeInscriptionsFiltre.php">
</form>

<p align="center" class="backgroundTitreColor"> Liste des <span>Inscriptions</span></p>



    <table align="center" border="1" cellpadding="0" cellspacing="1"
       id="table"
       data-toggle="table"
       data-search="true"
       data-filter-control="true"
       data-show-export="true"
       data-click-to-select="true"
       data-toolbar="#toolbar"
       data-pagination="true"
       class="table-responsive">
    <thead>
    <tr>
        <th>Action</th>
        <th data-field="identifiant" data-filter-control="input" data-sortable="true">Identifiant</th>
        <th data-filter-control="input" data-sortable="true">Nom Père</th>
        <th data-filter-control="input" data-sortable="true">Téléphone Père</th>
        <th data-filter-control="input" data-sortable="true">Nom Mère</th>
        <th data-filter-control="input" data-sortable="true">Téléphone Mère</th>
        <th data-filter-control="input" data-sortable="true">Email</th>
        <th data-filter-control="input">Les inscrits</th>
    </tr>
    </thead>
    <tbody>

    <?php

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
                $emailPere = $pere['email'];
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
            $findEnfantsSql = "SELECT * FROM eleve where id_inscription = '$idInscription' order by type_cours";
            $EleveRes = $mysqli->query($findEnfantsSql, MYSQLI_STORE_RESULT_COPY_DATA) ;

            if($EleveRes) {
                $nbrEleve = 0;
                $prenomAllEleves = "";
                while($eleve = $EleveRes->fetch_array()) {
                    $prenomAllEleves = $prenomAllEleves . "<br/> " .$eleve['prenom'] . " <b>(".getTypeCours($eleve['type_cours']).")</b>";
                    $nbrEleve++;
                }
                    ?>
                    <tr>
                        <th>
                            <img src="../ihm/images/fiche_engagement.png" title="Fiche Engagement" alt="Fiche Engagement" onclick="ficheEngagementPaiementInscription(<?php echo('\''.$idFoncInscription.'\',\''.$idInscription.'\'');?>);">
                            <img src="../ihm/images/icone-delete.png" title="Suppression" alt="Suppression" onclick="supprimerInscription(<?php echo('\''.$idFoncInscription.'\',\''.$idInscription.'\'');?>);">

                        </th>
                        <th> <?php echo($idFoncInscription);?> </th>
                        <td> <?php echo($nomPere ." ". $prenomPere);?> </td>
                        <td> <?php echo($portablePere);?></td>
                        <td><?php echo($nomMere ." ". $prenomMere);?> </td>
                        <td><?php echo($portableMere);?></td>
                        <td><?php echo($emailPere);?></td>
                        <td><?php echo($prenomAllEleves);?></td>
                    </tr>
                    <?php
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

    function getTypeCours($key) {
        if($key == 'ENF') {
            return 'Enfant';
        }
        if($key == 'ARABE') {
            return 'Arabe adulte';
        }
        if($key == 'SCIENCES_ISLAMIQUES') {
            return 'Sciences islamiques';
        }
        return 'inconnu';
    }


    ?>

    </tbody>
</table>

        </div></div></div></div></div></section>

</body></html>