<!DOCTYPE html>

<?php
require_once(__DIR__ . "/../service/conf/Config.php");
require_once(__DIR__ . "/../utils/fonctions.php");
include("../service/datasource/connectToBdd.php");
session_start();
?>

<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inscriptions - Inscrire Adulte</title>

    <link rel="stylesheet" href="css/bootstrap.min.css"/>
    <link rel="stylesheet" href="css/font-awesome.min.css"/>
    <link rel="stylesheet" href="css/animate.css"/>

    <link rel="stylesheet" href="css/style.css" />

    <script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCZXJBVDf7R4JqmSpopVPoduIGWx1IwpBM"></script>
    <script type="text/javascript" src="js/plugins.js"></script>


    </script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>

<!-- SVG -->
<div class="svg-wrap">
    <svg width="64" height="64" viewBox="0 0 64 64">
        <path id="arrow-left" d="M26.667 10.667q1.104 0 1.885 0.781t0.781 1.885q0 1.125-0.792 1.896l-14.104 14.104h41.563q1.104 0 1.885 0.781t0.781 1.885-0.781 1.885-1.885 0.781h-41.563l14.104 14.104q0.792 0.771 0.792 1.896 0 1.104-0.781 1.885t-1.885 0.781q-1.125 0-1.896-0.771l-18.667-18.667q-0.771-0.813-0.771-1.896t0.771-1.896l18.667-18.667q0.792-0.771 1.896-0.771z"></path>
    </svg>

    <svg width="64" height="64" viewBox="0 0 64 64">
        <path id="arrow-right" d="M37.333 10.667q1.125 0 1.896 0.771l18.667 18.667q0.771 0.771 0.771 1.896t-0.771 1.896l-18.667 18.667q-0.771 0.771-1.896 0.771-1.146 0-1.906-0.76t-0.76-1.906q0-1.125 0.771-1.896l14.125-14.104h-41.563q-1.104 0-1.885-0.781t-0.781-1.885 0.781-1.885 1.885-0.781h41.563l-14.125-14.104q-0.771-0.771-0.771-1.896 0-1.146 0.76-1.906t1.906-0.76z"></path>
    </svg>
</div>

<!--  ============== DEBUT - CONTENT PRINCIPAL DE LA PAGE ==================== -->
<div class="container-fluid">

    <!-- HEADER -->
    <section id="header">

        <!-- NAVIGATION -->
        <nav class="navbar navbar-fixed-top navbar-default bottom">
            <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#header">Institut Espoire - Inscriptions</a>
                </div><!-- /.navbar-header -->

                <div class="collapse navbar-collapse" id="menu">
                    <ul class="nav navbar-nav navbar-right">
                        <?php
                        if(isset($_SESSION['idInscription'])){
                            ?>
                            <form method="post" id="deconnexion" name="deconnexion" action="../service/deconnexionAction.php">
                                <INPUT TYPE='hidden' name='returnPage' value="ihm/index.php#connexion">
                                <li><button class="btn btn-default center-block submit">Déconnexion</button></li>
                            </form>
                            <?php
                        }
                        ?>
                    </ul>
                </div> <!-- /.navbar-collapse -->
            </div> <!-- /.container -->
        </nav>

        <!-- SLIDER -->
        <div class="header-slide">
            <section>
                <div id="loader" class="pageload-overlay" data-opening="M 0,0 0,60 80,60 80,0 z M 80,0 40,30 0,60 40,30 z">
                    <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 80 60" preserveAspectRatio="none">
                        <path d="M 0,0 0,60 80,60 80,0 Z M 80,0 80,60 0,60 0,0 Z"/>
                    </svg>
                </div> <!-- /.pageload-overlay -->

                <div class="image-slide bg-fixed">
                    <div class="overlay">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">

                                    <div class="slider-content">
                                        <h1></h1>
                                        <p>Association Culturelle Educative De Bron</p>
                                    </div>

                                </div> <!-- /.col-md-12 -->
                            </div> <!-- /.row -->
                        </div> <!-- /.container -->
                    </div> <!-- /.overlay -->
                </div> <!-- /.image-slide -->


            </section>

            <script type="text/javascript">
                var dataHeader = [
                        {
                            bigImage :"images/slide-2.jpg",
                            title : "Inscription 2021-2022"
                        },
                        {
                            bigImage :"images/institut-espoire.png",
                            title : "Institut Espoire"
                        }
                    ],
                    loaderSVG = new SVGLoader(document.getElementById('loader'), {speedIn : 800, speedOut : 800, easingIn : mina.easeinout});
                loaderSVG.show()
            </script>

        </div><!-- /.header-slide -->
    </section>
    <!-- HEADER END -->


    <script type="application/javascript">
        function checkInputForm()
        {
            /*
            // 1 - verifier que nbrEnfants est un nombre
            var nbr = document.forms["inscription"]["nbrEnfants"].value;
            if (isNaN(nbr)) {
                alert("!! Vous devez renseigner un nombre d'enfants !!");
                return false;
            }
            */
        }

        function activeElemnt(elm, id, isRequired) {

            if(elm.value == "1"){
                document.getElementById(id).disabled = false;
                document.getElementById(id).required = isRequired;
            } else {
                document.getElementById(id).disabled = true;
            }

        }

    </script>


    <form method="post" id="inscriptionAdulte" name="inscriptionAdulte" action="../service/ajouterAdulteAction.php" onsubmit="return checkInputForm()">
        <INPUT TYPE='hidden' name='returnPage' value="ihm/inscrire.php#inscrire">
        <INPUT TYPE='hidden' name='returnErrorPage' value="ihm/ajouterAdultes.php#adulte">
        <?php if(isset($_SESSION['idInscription']) ){?>
        <INPUT TYPE='hidden' name='idInscription' value="<?php  echo($_SESSION['idInscription'])?>">
        <INPUT TYPE='hidden' name='idFoncInscription' value="<?php  echo($_SESSION['idFoncInscription'])?>">
        <?php }?>
        <!-- Adulte -->
        <section id="adulte" class="dark">
            <header class="title">
                <h2>RENSEIGNEMENTS - <span>ADULTE</span></h2>
                <!--<p>Les champs avec * sont obligatoires </p>-->
            </header>
            <div class="container">
                <div class="row">
                    <div class="col-md-12 animated" data-animate="fadeInLeft">
                        <div class="row">
                            <div class="col-md-12">
                                <?php  if(isset($_SESSION['idFoncInscription']) ) { ?>
                                Votre identifiant d'inscription <a data-toggle="popover" title="Merci de le garder, il vous permettera de modifier votre inscription en ajoutant d'autres enfant par exemple"> (+) </a>
                                <?php  } else { ?>
                                Renseignez votre identifiant d'inscription <a data-toggle="popover" title="Merci de vous inscrir si vous ne possédez pas d'un numéro d'inscription"> (+) </a>
                                <?php  } ?>
                                <input type="text" id="idFoncInscription" name="idFoncInscription" class="identifiantinscription"
                                       value="<?php
                                       if(isset($_SESSION['idFoncInscription']) ) {
                                           echo($_SESSION['idFoncInscription'] . '" disabled>');
                                       } else {
                                           echo('" required>');
                                       } ?>
                                <?php  if(isset($_SESSION['idFoncInscriptionInconnu']) ) {
                                    echo($_SESSION['idFoncInscriptionInconnu']);
                                } ?>
                                <br/>
                            </div>

                            <div class="col-md-12">
                                <br/>
                            </div>
                            <div class="col-md-4">
                                Nom de l'élève <input type="text" name="nomAdulte" class="form-control" placeholder="Nom ... " required>
                            </div>
                            <div class="col-md-4">
                                Prémon de l'élève <input type="text" name="prenomAdulte" class="form-control" placeholder="Prénom ... " required>
                            </div>
                            <div class="col-md-4">
                                Sexe <select id="sexeAdulte" name="sexeAdulte" class="form-control" required>
                                    <option value="" class="backgroundBlackColor" selected>--</option>
                                    <option value="F" class="backgroundBlackColor" >FEMININ</option>
                                    <option value="M" class="backgroundBlackColor" >MASCULIN</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                Date de naissance<input type="date" id="dateNaissAdulte" name="dateNaissAdulte" class="form-control" placeholder="Date de naissance ... " required>
                            </div>
                            <div class="col-md-4">
                                Lieu de naissance <input type="text" id="lieuNaissAdulte" name="lieuNaissAdulte" class="form-control" placeholder="Lieu de naissance ... " required>
                            </div>
                            <div class="col-md-4">
                                Inscrir au cours de<select id="coursAdult" name="coursAdult" class="form-control" required>
                                    <option value="" class="backgroundBlackColor" selected>--</option>
                                    <option value="ARABE" class="backgroundBlackColor" >Arabe adulte</option>
                                    <option value="SCIENCES_ISLAMIQUES" class="backgroundBlackColor" >Sciences islamiques</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <br/>
                                <button class="btn btn-default center-block submit">Ajouter Adulte</button>
                                <br/><br/>
                            </div>
                            <div class="col-md-6">
                                <br/>
                                <a href="inscrire.php#inscrire"> Retour >> </a>
                                <br/><br/>
                            </div>
                            <?php if(isset($_SESSION['idInscription'])) {?>
                            <div class="col-md-12">
                                Liste d'adultes inscrits :
                                <br/>
                            </div>
                            <?php
                                    $idInsciption_ = $_SESSION['idInscription'];
                                    $findAdulteSql = "SELECT * from eleve where id_inscription='$idInsciption_' and (type_cours='SCIENCES_ISLAMIQUES' or type_cours='ARABE')";
                                    $mysqli = new mysqli(USE_SERVER_BDD, USE_LOGIN_BDD, USE_PASS_BDD, USE_NAME_BDD);

                                    $result = $mysqli->query($findAdulteSql, MYSQLI_STORE_RESULT_COPY_DATA) ;
                                    if($result) {
                                        $i = 0;
                                        while ($data = mysqli_fetch_array($result)) {
                                            $i++;
                                            $sexe = $data['sexe'];
                                            $prenom = $data['prenom'];
                                            $nom = $data['nom'];;
                                            $sexe = $data['sexe'];

                                            echo('<div class="col-md-3">');
                                            echo('<input type="text" name="enfant'.$i.'" class="alert enfant' . $sexe . '" value="' . $prenom . ' '. $nom.' " disabled>');
                                            echo('</div>');
                                        }
                                        if ($i == 0) {
                                            echo('<div class="col-md-4">');
                                            echo(' Aucun Adulte ajouté pour le moment ');
                                            echo('</div>');
                                        }
                                    } else {
                                        echo ('Erreur affichage Adultes : ' . $mysqli->error);
                                    }
                                }
                            ?>



                        </div>
                    </div>

                </div>
            </div>
        </section>


    </form>




        <!-- FORMULAIRE - CONTACTER NOUS
        <section id="contact" class="dark">
            <header class="title">
                <h2>Nous contacter <span>Fr</span></h2>
                <p>Pour plus d'informations, vous pouvez nous envoyer vos questions/remarques via ce formulaire</p>
            </header>
            <div class="container">
                <div class="row">
                    <div class="col-md-8 animated" data-animate="fadeInLeft">
                        <form action="#">
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="text" class="form-control" placeholder="Votre Nom">
                                </div>
                                <div class="col-md-6">
                                    <input type="email" class="form-control" placeholder="Votre Email">
                                </div>
                                <div class="col-md-12">
                                    <textarea class="form-control" rows="3" placeholder="Message..."></textarea>
                                </div>
                                <div class="col-md-12">
                                    <button class="btn btn-default submit">Envoi Message</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="col-md-4 animated" data-animate="fadeInRight">
                        <address>
                            <span><i class="fa fa-map-marker fa-lg"></i> 362 Route de Genas, 69500 Bron</span>
                            <span><i class="fa fa-phone fa-lg"></i> (33) 6 87 93 16 89 </span>
                            <span><i class="fa fa-envelope-o fa-lg"></i> <a href="mailto:inscriptions.institutespoir@gmail.com">contact&#64; inscriptions.institutespoir@gmail.com</a></span>
                            <span><i class="fa fa-globe fa-lg"></i> <a href="http://support.example.com">support.example.com</a></span>
                        </address>
                    </div>

                </div>
            </div>
        </section>
        -->
        <section id="footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <p>ASSOCIATION CULTURELLE EDUCATIVE DE BRON</p>
                        <p><i class="fa fa-heart"></i><small>  Institut Espoire  </small><i class="fa fa-heart"></i></p>
                    </div>
                </div>
            </div>
        </section>

</div><!-- /.container-fluid -->
<!--  ============== FIN - CONTENT PRINCIPAL DE LA PAGE ==================== -->

<!-- SCRIPT -->
<script type="text/javascript" src="js/main.js"></script>
</body>
</html>