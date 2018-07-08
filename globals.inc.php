<?php
// Globals
$GAME   = getActiveGame()[1];
$GAMEID = getActiveGame()[0];

define( "_GAME", $GAME );
define( "_GAMEID", $GAMEID );

define( "_DR", $_SERVER["DOCUMENT_ROOT"] );
define( "_PATH", dirname(__FILE__) );
define( "_FLASKS", 20 ); // Number of Flasks
define( "_LOGIN", FALSE );
define( "_SHOWTODO", FALSE );
define( "_NEWGAMEPLUS", FALSE );

define( "_WARNINGMAIL", TRUE );
define( "_EMAIL", "patrick@nauerz.net" );

define( "_TIMEZONE", "Europe/Berlin" );

// Check timezone
$timezone = date_default_timezone_get();
if ( strcmp($timezone, _TIMEZONE) ) date_default_timezone_set("Europe/Berlin");
?>