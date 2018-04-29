<?php
// Info
// phpinfo() = 5.3.10
// phpinfo() = 7.1.16

// Set up DB and connect
$host     = "127.0.0.1";
$db       = "";
$user     = "";
$pass     = "";
$charset  = "utf8";

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";


$opt = [
  PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_BOTH,
  PDO::ATTR_EMULATE_PREPARES   => false,
];


$pdo = new PDO ($dsn, $user, $pass, $opt); // pdo instance
/*
// PHP 5
$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION ); // error handling
$pdo->setAttribute( PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_BOTH ); // standard fetch mode
$pdo->setAttribute( PDO::ATTR_EMULATE_PREPARES, false ); // emulate prep
*/

/* BASE TABLE*/
define("_TABLE", "ds3");
define("_GAME", "ds3");
$dbTable = TABLE;

define( "_DR", $_SERVER["DOCUMENT_ROOT"] );
define( "_PATH", dirname(__FILE__) );
define( "_FLASKS", 15 ); // Number of Flasks
define( "_LOGIN", TRUE )
  
  
// Session
// ob_start();
// session_start();
// $_SESSION["valid"]     = true;
// $_SESSION["timeout"]   = time();
// $_SESSION["username"]  = $user;
?>