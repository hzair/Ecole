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
    <title>Inscriptions - Demande d'informations</title>

    <link rel="stylesheet" href="css/bootstrap.min.css"/>
    <link rel="stylesheet" href="css/font-awesome.min.css"/>
    <link rel="stylesheet" href="css/animate.css"/>

		<link rel="stylesheet" href="css/style.css" />

    <script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCZXJBVDf7R4JqmSpopVPoduIGWx1IwpBM"></script>
    <script type="text/javascript" src="js/plugins.js"></script>

        <script type="application/javascript">
            function checkInputForm()
            {
                return true;
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


                //var elmt = document.getElementById(id).;
            }

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

              </div><!-- /.navbar-header -->

              <div class="collapse navbar-collapse" id="menu">
                <ul class="nav navbar-nav navbar-right">
                  <li><a href="#connexion">Connexion/Nouveau</a></li>
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
                          <p>Choisir ce que vous voulez inscrire :</p>
                            <br/>
                          <p>
                              <a class="btn alert-danger btn-default submit" href="creerCompte.php#compte">Un ou plusieurs Enfants</a>
                              &nbsp; &nbsp;
                              <a class="btn  btn-default submit" href="creerCompteAdulte.php#adulte">Un Adulte Seul</a>
                          </p>
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
                                  bigImage :"images/slide-2.jpg",
                                  title : "Institut Espoir"
                                }
                            ],
                loaderSVG = new SVGLoader(document.getElementById('loader_'), {speedIn : 800, speedOut : 800, easingIn : mina.easeinout});
                loaderSVG.show()
            </script>

          </div><!-- /.header-slide -->
        </section>
        <!-- HEADER END -->



        <!-- FORMULAIRE - CONTACTER NOUS -->
         <section id="connexion" class="dark">
          <header class="title">
            <h2>Se connecter <span>ou</span> créer un compte</h2>
            <p>Si vous avez déjà créé votre compte, connectez-vous et modifiez votre inscription. Sinon créez un nouveau compte</p>
          </header>
          <div class="container">
            <div class="row">
              <div class="col-md-8 animated" <?php if(!isset($_SESSION['messageError'])) {?>data-animate="fadeInLeft" <?php } ?>>
                <form method="post" id="connexion" name="connexion" action="../service/connexionAction.php" onsubmit="return checkInputForm()">
                    <INPUT TYPE='hidden' name='returnPage' value="ihm/inscrire.php#inscrire">
                    <INPUT TYPE='hidden' name='returnErrorPage' value="ihm/index.php#connexion">
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
                        <div class="col-md-9">
                            <input type="text" id="idFoncInscription" name="idFoncInscription" class="form-control" placeholder="Identifiant inscription ..." required>
                        </div>
                        <div class="col-md-3">
                            <button class="btn alert-info btn-default submit">Se connecter</button>
                        </div>
                        <div class="col-md-12">
                            <a href="creerCompte.php#compte"> Créer nouveau Compte </a>
                        </div>
                  </div>
                </form>
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