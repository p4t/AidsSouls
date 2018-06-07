<?php
require_once( "globals.inc.php" );

$ds1 = array (
  "VIT",
  "ATT",
  "END",
  "STR",
  "DEX",
  "INT",
  "FTH",
  "FFA",
  "FFA",
  "FFA",
  "FFA",
  "FFA",
  "FFA",
  "FFA"
);

$ds2 = array (
  "VIG",
  "END",
  "VIT",
  "ATT",
  "STR",
  "DEX",
  "ADP",
  "INT",
  "FTH",
  "FFA",
  "FFA",
  "FFA"
);

$ds3 = array (
  "VIG",
  "ATT",
  "END",
  "VIT",
  "STR",
  "DEX",
  "INT",
  "FTH",
  "LCK",
  "FFA",
  "FFA",
  "FFA"
);

$ds1r = array (
  "VIT",
  "ATT",
  "END",
  "STR",
  "DEX",
  "INT",
  "FTH",
  "FFA",
  "FFA",
  "FFA",
  "FFA",
  "FFA",
  "FFA",
  "FFA"
);

$bb = array (
  "VIT",
  "END",
  "STR",
  "SKL",
  "BLT",
  "ARC",
  "FFA",
  "FFA",
  "FFA",
  "FFA",
  "FFA",
  "FFA"
);


if      ( _GAME == "ds1"  ) $stats = $ds1;
elseif  ( _GAME == "ds2"  ) $stats = $ds2;
elseif  ( _GAME == "ds3"  ) $stats = $ds3;
elseif  ( _GAME == "ds1r" ) $stats = $ds1r;
elseif  ( _GAME == "bb"   ) $stats = $bb;


// sort($stats);
echo json_encode( $stats );
?>

 