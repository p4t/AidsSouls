<?php
// Globals
$GAME   = getGame()[1];
$GAMEID = getGame()[0];
define( "_GAME", $GAME );
define( "_GAMEID", $GAMEID );

define( "_DR", $_SERVER["DOCUMENT_ROOT"] );
define( "_PATH", dirname(__FILE__) );
define( "_FLASKS", 20 ); // Number of Flasks
define( "_LOGIN", FALSE );
define( "_SHOWTODO", FALSE );
define( "_NEWGAMEPLUS", FALSE );

// Set default Timezone
// date_default_timezone_set("Europe/Berlin");

// Check timezone
$timezone = date_default_timezone_get();
if ( strcmp($timezone, "Europe/Berlin") ) date_default_timezone_set("Europe/Berlin");
?>