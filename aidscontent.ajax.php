<?php
// Lib
require_once( $_SERVER["DOCUMENT_ROOT"] . "/config.db.php" );
require_once( $_SERVER["DOCUMENT_ROOT"] . "/functions.inc.php" );
require_once( $_SERVER["DOCUMENT_ROOT"] . "/globals.inc.php" );

// Aids
$firstPageLoad = FALSE; // Set to false so roll.inc.php knows to actually roll dice
include_once( $_SERVER["DOCUMENT_ROOT"] . "/roll.inc.php" ); // main aids roll function
include_once( $_SERVER["DOCUMENT_ROOT"] . "/aids.css.php" ); // special aids CSS
include_once( $_SERVER["DOCUMENT_ROOT"] . "/flex-container-aids.tpl.php" ); // aids output HTML
?>
<script>
  /*
  * Invoke run() @run.js
  * Rolls dice 1-100, show events at certain numbers
  */
  run();
</script>