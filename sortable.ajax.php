<?php
// Lib
require_once( $_SERVER["DOCUMENT_ROOT"] . "/config.db.php" );
require_once( $_SERVER["DOCUMENT_ROOT"] . "/functions.inc.php" );
require_once( $_SERVER["DOCUMENT_ROOT"] . "/globals.inc.php" );

/**
 * jQuery Sortable AJAX
 */
$sql_query    = "";
$getVars      = array_keys($_GET); // get index name of the _GET[]
(STRING)$GET  =  $getVars[0]; // make sure it's a string
$table        = $GET;

foreach ( $_GET["{$GET}"] as $position => $item ) {
  $position++; // start array index at 1 instead 0
  // Debug
  // $sql[]   = "UPDATE $table SET `dice` = $position WHERE `ID` = $item;";
  $sql_query .= "UPDATE $table SET `dice` = $position WHERE `ID` = $item;"; // all in one query
}

//DEBUG
//print_r($sql_query);

$pdo->exec($sql_query); // execute all at once
?>