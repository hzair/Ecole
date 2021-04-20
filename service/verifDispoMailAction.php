 <?php
 	require_once(__DIR__ . "/conf/Config.php");
 	require_once(__DIR__ . "/../utils/fonctions.php");
 	include("datasource/connectToBdd.php");

	header ("content-type: text/xml");

    $mysqli = new mysqli(USE_SERVER_BDD, USE_LOGIN_BDD, USE_PASS_BDD, USE_NAME_BDD);
	
	$mail=$_GET["mail"];
	
	//initialiser le resultat
	$resultat = "dispo";

	 $emailMajuscul = strtoupper($mail);

	 $sql = "SELECT upper(email) FROM inscription where upper(email)='$emailMajuscul'";
	 $resultQ = $mysqli->query($sql, MYSQLI_STORE_RESULT_COPY_DATA) ;

	 while($data = mysqli_fetch_array($resultQ) && $resultat == "dispo"){
		 if($data['upper(email)'] == $emailMajuscul) {
			 $resultat = "nondispo";
		 }
		 else {
			 $resultat = "dispo";
		 }
	 }

    /* Fermeture de la connexion */
    $mysqli->close();

	echo($resultat);
