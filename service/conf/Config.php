<?php

abstract class Environnement {
    const local = "local";
    const integration = "int";
    const production = "pro";
}

define("ENV", Environnement::local);

$SERVER_BDD = [
    Environnement::local => "localhost:3306",
    Environnement::integration => "TODO...",
    Environnement::production => "TODO..."
];
$USE_LOGIN_BDD = [
    Environnement::local => "ecole",
    Environnement::integration => "TODO...",
    Environnement::production => "TODO..."
];
$PASS_BDD = [
    Environnement::local => "ecole",
    Environnement::integration => "TODO...",
    Environnement::production => "TODO..."
];
$NAME_BDD = [
    Environnement::local => "ecole",
    Environnement::integration => "TODO...",
    Environnement::production => "TODO..."
];

define("USE_SERVER_BDD", $SERVER_BDD[ENV]);
define("USE_LOGIN_BDD", $USE_LOGIN_BDD[ENV]);
define('USE_PASS_BDD', $PASS_BDD[ENV]);
define("USE_NAME_BDD", $NAME_BDD[ENV]);


// -----------------------------------------------------------------------------

?>