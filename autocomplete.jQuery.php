<?php
// Lib
require_once( $_SERVER["DOCUMENT_ROOT"] . "/config.db.php" );
require_once( $_SERVER["DOCUMENT_ROOT"] . "/functions.inc.php" );
require_once( $_SERVER["DOCUMENT_ROOT"] . "/globals.inc.php" );

if      ( _GAME == "des"  ) include( $_SERVER["DOCUMENT_ROOT"] . "/autocomplete/des.php"   );
elseif  ( _GAME == "ds1"  ) include( $_SERVER["DOCUMENT_ROOT"] . "/autocomplete/ds1.php"   );
elseif  ( _GAME == "ds2"  ) include( $_SERVER["DOCUMENT_ROOT"] . "/autocomplete/ds2.php"   );
elseif  ( _GAME == "ds3"  ) include( $_SERVER["DOCUMENT_ROOT"] . "/autocomplete/ds3.php"   );
elseif  ( _GAME == "ds1r" ) include( $_SERVER["DOCUMENT_ROOT"] . "/autocomplete/ds1r.php"  );
elseif  ( _GAME == "bb"   ) include( $_SERVER["DOCUMENT_ROOT"] . "/autocomplete/bb.php"    );
else                        $weapons = "";

echo json_encode( $weapons );
?>