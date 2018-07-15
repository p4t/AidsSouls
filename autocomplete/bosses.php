<?php
// Lib
require_once( $_SERVER["DOCUMENT_ROOT"] . "/config.db.php"      );
require_once( $_SERVER["DOCUMENT_ROOT"] . "/functions.inc.php"  );
require_once( $_SERVER["DOCUMENT_ROOT"] . "/globals.inc.php"    );

if     ( _GAME == "des"   ) include( $_SERVER["DOCUMENT_ROOT"] . "/autocomplete/des.bosses.php"  );
elseif ( _GAME == "ds1"   ) include( $_SERVER["DOCUMENT_ROOT"] . "/autocomplete/ds1.bosses.php"  );
elseif ( _GAME == "ds2"   ) include( $_SERVER["DOCUMENT_ROOT"] . "/autocomplete/ds2.bosses.php"  );
elseif ( _GAME == "ds3"   ) include( $_SERVER["DOCUMENT_ROOT"] . "/autocomplete/ds3.bosses.php"  );
elseif ( _GAME == "ds1r"  ) include( $_SERVER["DOCUMENT_ROOT"] . "/autocomplete/ds1r.bosses.php" );
elseif ( _GAME == "bb"    ) include( $_SERVER["DOCUMENT_ROOT"] . "/autocomplete/bb.bosses.php"   );
else                        $bosses = "";

echo json_encode( $bosses );
?>