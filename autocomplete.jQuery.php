<?php
require_once( "globals.inc.php" );
if ( _GAME == "ds1" ) include( "autocomplete/ds1.php" );
elseif ( _GAME == "ds2" ) include( "autocomplete/ds2.php" );
elseif ( _GAME == "ds3" ) include( "autocomplete/ds3.php" );
elseif ( _GAME == "ds1r" ) include( "autocomplete/ds1r.php" );
elseif ( _GAME == "bb" ) include( "autocomplete/bb.php" );
echo json_encode( $weapons );
?>