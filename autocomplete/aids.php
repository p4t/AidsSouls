<?php
// Lib
require_once( $_SERVER["DOCUMENT_ROOT"] . "/config.db.php" );
require_once( $_SERVER["DOCUMENT_ROOT"] . "/functions.inc.php" );
require_once( $_SERVER["DOCUMENT_ROOT"] . "/globals.inc.php" );

$aids = array (
  "Zufällige Waffe",
  "Jäscher",
  "Feige",
  "Flask Würfeln",
  "Ohne Schild",
  "Ohne Flask",
  "Ohne Rüstung",
  "Fatroll",
  "Waffe linke Hand",
  "Nur R2",
  "Nur RT",
  "Lumbe",
  "Crap Waffe",
  "Ohne Ringe",
  "Ohne Alles",
  "Crap Ringe",
  "Normal",
  "No Dodge/Run",
  "Invert Controls",
  "Kill on Sight",
  "Parry",
  "Invade",
  "Symbol of Aids",
  "Kill on Sight",
  "Fashion Souls",
  "Weapon Type",
  "No Dodge",
  "No Run",
  "Zweihand",
  "No Crit",
  "Waffe +X Würfel",
  "No Consumables",
  "Nur Schild",
  "No Hit Run",
  "Nur MAGIE",
  "Dragon Torso",
  "Crap Shield",
  "No HUD",
  "Dried Finger",
  "Always Sunny",
  "Cosplay"
);
sort($aids);
echo json_encode( $aids );
?>