<html lang="en" xmlns="http://www.w3.org/1999/html">
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
    <title>LISTE ELEVES </title>

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

    function supprimerEleve(id, nom, dateNaiss){
        if(confirm("Voulez-vous supprimer définitivement l'eléve '" + nom + "' né(e) le '" + dateNaiss +"' ?")) {
            var formElmt = document.getElementById("supp_eleve_form");
            formElmt.idInscription.value = id;
            formElmt.submit();
        }
    }

    function modiferEleve(idFonc, id){
        var formElmt = document.getElementById("modif_inscription_form");
        formElmt.idFoncInscription.value = idFonc;
        formElmt.idInscription.value = id;
        formElmt.submit();
    }

    function deplacerVersInscription(myIdInscription, id, nom, dateNaiss) {
        var newIdInscription = document.getElementById("newIdInscription_" + id);
        if(newIdInscription.value == "-") {
            return;
        }
        if(confirm("Voulez-vous déplacer l'eléve '" + nom + "' né(e) le '" + dateNaiss
                + "' vers l'inscription '" +newIdInscription.value+"' ?")) {
            var formElmt = document.getElementById("deplacer_vers_inscription_form");
            formElmt.idNewInscription.value = newIdInscription.value;
            formElmt.idEleve.value = newIdInscription.value;
            formElmt.submit();
        }
    }


</script>

<form action="deleteEleveAction.php" method="post" id="supp_eleve_form" >
    <INPUT TYPE="hidden" id= "idInscription" name="idInscription" value="">
    <INPUT TYPE='hidden' name='returnPage' value="admin/listeElevesFiltre.php">
    <INPUT TYPE='hidden' name='returnErrorPage' value="admin/listeElevesFiltre.php">
</form>
<form action="majInscriptionAction.php" method="post" id="modif_inscription_form" >
    <INPUT TYPE="hidden" id="idFoncInscription" name="idFoncInscription" value="">
    <INPUT TYPE="hidden" id= "idInscription" name="idInscription" value="">
    <INPUT TYPE='hidden' name='returnPage' value="admin/listeElevesFiltre.php">
    <INPUT TYPE='hidden' name='returnErrorPage' value="admin/listeElevesFiltre.php">
</form>
<form action="deplacerEleveAction.php" method="post" id="deplacer_vers_inscription_form" >
    <INPUT TYPE="hidden" id="idNewInscription" name="idNewInscription" value="">
    <INPUT TYPE="hidden" id= "idEleve" name="idEleve" value="">
    <INPUT TYPE='hidden' name='returnPage' value="admin/listeElevesFiltre.php">
    <INPUT TYPE='hidden' name='returnErrorPage' value="admin/listeElevesFiltre.php">
</form>

<p align="center" class="backgroundTitreColor"> Liste des <span>Elèves</span></p>
        <!--<p>Les champs avec * sont obligatoires </p>-->


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
        <th data-filter-control="input" data-sortable="true">Nom</th>
        <th data-filter-control="input" data-sortable="true">Prenom</th>
        <th data-filter-control="input" data-sortable="true">Sexe</th>
        <th data-filter-control="input" data-sortable="true">Date Naissance</th>
        <th data-filter-control="input" data-sortable="true">Type Cours</th>
        <th data-filter-control="input" data-sortable="true">Classe année 2020</th>
    </tr>
    </thead>
    <tbody>

    <?php

    $mysqli = new mysqli(USE_SERVER_BDD, USE_LOGIN_BDD, USE_PASS_BDD, USE_NAME_BDD);

    $findAllInscriptionSql = "SELECT id, id_fonc from inscription";
    $listinscription = $mysqli->query($findAllInscriptionSql) ;
    //$inscriptions = mysqli_fetch_array($listinscription);
    $i = 0;
    while ($inscriptions = mysqli_fetch_array($listinscription)) {
        $inscripTab[$i] = $inscriptions;
        $i++;
    }



    $findAllElevesSql = "SELECT * from eleve";
    $listEleves = $mysqli->query($findAllElevesSql, MYSQLI_STORE_RESULT_COPY_DATA) ;
    if($listEleves) {
        $i = 0;
        while ($eleve = mysqli_fetch_array($listEleves)) {
            $i++;
            $id = $eleve['id'];
            $idInscription = $eleve['id_inscription'];
            $typeCours = $eleve['type_cours'];
            $nom = $eleve['nom'];
            $prenom = $eleve['prenom'];
            $sexe = $eleve['sexe'];
            $dateNaiss = $eleve['date_naissance'];
            $numClass = $eleve['num_annee_prec_ici'];


                    ?>
                    <tr>
                        <th>
                            <img src="../ihm/images/icone-modif.png" title="modifier" alt="Modifier" onclick="modifierEleve(<?php echo('\''.$idInscription.'\'');?>);">
                            <img src="../ihm/images/icone-delete.png" title="Suppression" alt="Suppression" onclick="supprimerEleve(<?php echo('\''.$idInscription.'\',\''.$prenom.'\',\''.$dateNaiss.'\'');?>);">

                        </th>
                        <td>
                            <?php echo($idInscription);?> <br/>
                            <select id="newIdInscription_<?php echo($id);?>" name="newIdInscription_<?php echo($id);?>" required>
                                <?php
                                for ($i = 0; $i < count($inscripTab); $i++) {
                                    $inscr = $inscripTab[$i];
                                    if($inscr['id'] == $idInscription) {
                                        echo("<option value='-' selected> -> ".$inscr['id_fonc']."</option>");
                                    } else {
                                        echo("<option value='".$inscr['id']."'>".$inscr['id_fonc']."</option>");
                                    }
                                }
                                ?>
                            </select>

                            <a onclick="deplacerVersInscription(<?php echo('\''.$idInscription .'\',\''.$id.'\',\''.$prenom.'\',\''.$dateNaiss.'\'');?>)">déplacer</a>
                        </td>
                        <th> <?php echo($nom);?> </th>
                        <td> <?php echo($prenom);?> </td>
                        <td> <?php echo($sexe);?></td>
                        <td><?php echo($dateNaiss);?> </td>
                        <td><?php echo($typeCours);?></td>
                        <td><?php echo($numClass);?></td>
                    </tr>
                    <?php

        }
    } else {
        echo ('Erreur de récupération de la liste des inscriptions : ' . $mysqli->error);
    }


    ?>

    </tbody>
</table>

        </div></div></div></div></div></section>

</body></html>