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
    <title>Inscriptions - Création Compte</title>

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

        <script type="application/javascript">
            function verifierDisponibMail(str){
                //Ajaxe
                if (window.XMLHttpRequest){
                    // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                }
                else{
                    // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange=function(){
                    if (xmlhttp.readyState==4 && xmlhttp.status==200){
                        var reponse = xmlhttp.responseText;
                        var n=reponse.search("nondispo");
                        if(n!="-1"){
                            alert("Email déjà utilisé pour un autre compte\n Merci de choisir un autre mail ou se connecter sur votre ancien compte")
                        }
                    }
                }
                xmlhttp.open("GET", "../service/verifDispoMailAction.php?mail="+str, true);
                xmlhttp.send();
            }


            function checkInputForm() {
                // 1 - verifier que nbrEnfants est un nombre
                var email = document.forms["inscription"]["email"].value;
                var _at = email.search("@");
                var _dot = 	email.search(".");
                if(_at=="-1" || _dot=="-1"){
                    alert("Le format Email est non valide. (Ex: monEmail@nomDomaine.xx)");
                    return false;
                }
            }

            function activeElemnt(name1, name2) {
                $(document).ready(function(){
                    $(select[name=name1]).on('change',function(){
                        if($(this).val()==1){
                            $("input[name=name2]").prop("disabled",false);
                        }else{
                            $("input[name=name2]").prop("disabled",true);
                        }
                    });
                });


            }

            function togg(_this){
                let d1 = document.getElementById("conditionIframe");
                if(getComputedStyle(d1).display != "none"){
                    _this.value = "afficher";
                    d1.style.display = "none";
                } else {
                    _this.value = "masquer";
                    d1.style.display = "block";
                }
            };

        </script>

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
                <a class="navbar-brand" href="#header">Institut Espoir - Inscriptions</a>
              </div><!-- /.navbar-header -->

              <div class="collapse navbar-collapse" id="menu">
                <ul class="nav navbar-nav navbar-right">
                  <li><a href="#compte">Créer un compte</a></li>
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
                                  bigImage :"images/institut-espoir.png",
                                  title : "Institut Espoir"
                                }
                            ],
                loaderSVG = new SVGLoader(document.getElementById('loader'), {speedIn : 800, speedOut : 800, easingIn : mina.easeinout});
                loaderSVG.show()
            </script>

          </div><!-- /.header-slide -->
        </section>
        <!-- HEADER END -->




      <form method="post" id="compte" name="inscription" action="../service/ajouterInscriptionParentsAction.php" onsubmit="return checkInputForm()">
        <INPUT TYPE='hidden' name='returnPage' value="ihm/inscrire.php#inscrire">
        <INPUT TYPE='hidden' name='returnErrorPage' value="ihm/creerCompte.php#parents">

        <!-- Creation Inscription avec information parent -->
        <section id="parents" class="dark">
        <header class="title">
          <h2>RENSEIGNEMENTS DES <span>PARENTS</span></h2>
          <!--<p>Les champs avec * sont obligatoires </p>-->
        </header>
        <div class="container">
          <div class="row">
            <div class="col-md-12 animated" data-animate="fadeInLeft">
                <div class="row">
                    <div class="col-md-12 animated messageErrorColore"
                         data-animate="fadeInLeft" role="alert">
                        <?php
                        if(isset($_SESSION['messageError'])) {
                            if ($_SESSION['messageError'] != null) {
                                echo ('<p class="text-danger">' . $_SESSION['messageError'] . '</p>');
                                unset($_SESSION['messageError']);
                            }
                        }
                        ?>
                    </div>
                  <div class="col-md-12">
                    <h3>Père</h3>
                  </div>
                  <div class="col-md-3">
                    Nom <input type="text" name="nomPere" class="form-control" placeholder="Nom du père" required>
                  </div>
                  <div class="col-md-3">
                    Prénom <input type="text" name="prenomPere" class="form-control" placeholder="prénom du père" required>
                  </div>
                  <div class="col-md-3">
                    Profession <input type="text" name="professionPere" class="form-control" placeholder="Profession du père">
                  </div>
                  <div class="col-md-3">
                    Tél. portable <input type="text" name="portablePere" class="form-control" placeholder="Tél. portable du père" required>
                  </div>

                  <div class="col-md-12">
                    <h3>Mère</h3>
                  </div>
                  <div class="col-md-3">
                    Nom <input type="text" name="nomMere" class="form-control" placeholder="Nom du mère" required>
                  </div>
                  <div class="col-md-3">
                    Prénom <input type="text" name="prenomMere" class="form-control" placeholder="prénom du mère" required>
                  </div>
                  <div class="col-md-3">
                    Profession <input type="text" name="professionMere" class="form-control" placeholder="Profession du mère">
                  </div>
                  <div class="col-md-3">
                    Tél. portable <input type="text" name="portableMere" class="form-control" placeholder="Tél. portable du mère" required>
                  </div>

                  <div class="col-md-4">
                    <br/>
                    Parents séparés <select id="parentsSepare" name="parentsSepare" class="form-control" required>
                                      <option value="" class="backgroundBlackColor" selected>--</option>
                                      <option value="0" class="backgroundBlackColor">NON</option>
                                      <option value="1" class="backgroundBlackColor">OUI</option>
                                    </select>
                  </div>
                  <div class="col-md-4">
                    <br/>
                    Adresse e-mail <input type="email" id="email" name="email" class="form-control" placeholder="Adresse e-mail"
                                          onchange="verifierDisponibMail(this.value)" required>
                  </div>
                  <div class="col-md-4">
                    <br/>
                    Téléphone fixe <input type="tel" name="telephoneFixe" class="form-control" placeholder="Téléphone fixe">
                  </div>
                  <div class="col-md-6">
                    Adresse postale <input type="" name="adressePostale" class="form-control" placeholder="Adresse postale" required>
                  </div>
                  <div class="col-md-3">
                    Code postale <input type="text" name="codePostale" class="form-control" placeholder="Code postale" required>
                  </div>
                  <div class="col-md-3">
                    Ville <input type="text" name="ville" class="form-control" rows="1" placeholder="Ville" required>
                  </div>
                  <div class="col-md-12">
                      <input type="checkbox" name="condition" rows="1" required>
                      Je déclare avoir pris connaissance des <a href="doc/conditions_d_inscription_et_du_reglement_2021-2022.pdf" onclick="window.open(this.href); return false;">conditions d'inscription et du règlement</a> ainsi que les modalités qui me sont proposées.
                      <input type="button" id="conditionIframeAff" class="btn-info" onclick="togg(this)" value="afficher">
                  </div>

                </div>
                <div class="col-md-12">
                  </br>
                  <button class="btn btn-default center-block submit">Envoyer</button>
                </div>
                <div class="col-md-12" id="conditionIframe" style="display: none">
                    <iframe src="doc/conditions_d_inscription_et_du_reglement_2021-2022.pdf" width="90%" height="500" style="border: none;"></iframe>
                </div>
            </div>

          </div>
        </div>
      </section>








        <section id="footer">
          <div class="container">
            <div class="row">
              <div class="col-md-12 text-center">
                <p>ASSOCIATION CULTURELLE EDUCATIVE DE BRON</p>
                <p><i class="fa fa-heart"></i><small>  Institut Espoir  </small><i class="fa fa-heart"></i></p>
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