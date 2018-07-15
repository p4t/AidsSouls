<?php
// Lib
require_once( $_SERVER["DOCUMENT_ROOT"] . "/config.db.php" );
require_once( $_SERVER["DOCUMENT_ROOT"] . "/functions.inc.php" );
require_once( $_SERVER["DOCUMENT_ROOT"] . "/globals.inc.php" );

if     ( _GAME == "des" ) include( "autocomplete/des.bosses.php" );
elseif ( _GAME == "ds1" ) include( "autocomplete/ds1.bosses.php" );
elseif ( _GAME == "ds2" ) include( "autocomplete/ds2.bosses.php" );
elseif ( _GAME == "ds3" ) include( "autocomplete/ds3.bosses.php" );
elseif ( _GAME == "ds1r" ) include( "autocomplete/ds1r.bosses.php" );
elseif ( _GAME == "bb" ) include( "autocomplete/bb.bosses.php" );
echo json_encode( $bosses );
?>