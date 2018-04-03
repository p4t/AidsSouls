<?php
// Set up DB and connect
$host     = "";
$db       = "";
$user     = "";
$pass     = "";
$charset  = "utf8";

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

/*
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
*/

$pdo = new PDO ($dsn, $user, $pass); // pdo instance
$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION ); // error handling
$pdo->setAttribute( PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_BOTH ); // standard fetch mode
$pdo->setAttribute( PDO::ATTR_EMULATE_PREPARES, false ); // emulate prep

/* BASE TABLE*/
define("TABLE", "ds3");
$dbTable = TABLE;

define("__DR", $_SERVER["DOCUMENT_ROOT"]);
?>