<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    require_once(__DIR__ . "/../conf/Config.php");
    include("../datasource/connectToBdd.php");

    $mysqli = new mysqli(USE_SERVER_BDD, USE_LOGIN_BDD, USE_PASS_BDD, USE_NAME_BDD);

    $sql = "INSERT INTO `inscription` (`id`, `id_pere`, `id_mere`, `date`, `parents_separe`) VALUES (NULL, NULL, NULL, NOW(), NULL)";

    $result = $mysqli->query($sql);
    if($result){
        $sql2 = "SELECT MAX(id) FROM inscription ";
        $result2 = $mysqli->query($sql2);
        $data2 = $result2->fetch_array();
        print(json_encode($data2["MAX(id)"]));
    } else {
        print(json_encode("erreur de creation inscription : " . $result));
    }

    /* Fermeture de la connexion */
    $mysqli->close();





}

