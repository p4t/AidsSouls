<?php
// Get random number
$RNG        = getRNG();
$mobsRNG    = $RNG[0];
$bossRNG    = $RNG[1];

// Get random number for NG+
$RNGNGP        = getRNG();
$mobsRNGNGP    = $RNGNGP[0];
$bossRNGNGP    = $RNGNGP[1];

$flasks     = _FLASKS;
$weaponIMG  = "<img src=\"/img/weapon_icon.png\" width=\"30\" height=\"30\" alt=\"Weapon\">"; // 41, 40

// DEBUG
// $mobsRNG = 15;
// $bossRNG = 5;

if ( !empty($_GET["RNG"]) ) {
  $mobsRNG = $_GET["RNG"];
  $bossRNG = $_GET["RNG"];
}
if ( !empty($_GET["mobsRNG"]) ) {
  $mobsRNG = $_GET["mobsRNG"];  
}
if ( !empty($_GET["bossRNG"]) ) {
  $bossRNG = $_GET["bossRNG"];
}


// Get Aids from mobs boss tables 
$Aids     = getAidsByRNG($mobsRNG, $bossRNG);
$mobsAids = $Aids[0];
$bossAids = $Aids[1];

// Get aids from mobs boss tables for NG+
$AidsNGP     = getAidsByRNG($mobsRNGNGP, $bossRNGNGP);
$mobsAidsNGP = $AidsNGP[0];
$bossAidsNGP = $AidsNGP[1];

// Output for dice-wrapper display
$mobsRNG_Output = replaceDiceWithSymbol ($mobsAids, $mobsRNG);
$bossRNG_Output = replaceDiceWithSymbol ($bossAids, $bossRNG);

// Random Weapon
// $randomWeapon = randomWeapon();

// Debug
// $debug = debug($mobsRNG, $mobsAids, $bossRNG, $bossAids, $randomWeapon);

// Write aids rolls into DB
saveRolls($mobsAids, $bossAids); // Table/Output in edit.php

if ( _CSSAIDS == "TRUE" ) {

  // No HUD
  if ( $mobsAids == "No HUD" || $bossAids == "No HUD" ) {
    $HUD_CSS = TRUE;
  }

  // Invert Controls
  if ( $mobsAids == "Invert Controls" || $bossAids == "Invert Controls" ) {
    $INVERT_CSS = TRUE;
  }

  // Shots
  $shots = array("Feige", "Jäscher");
  $bothAids = array($mobsAids, $bossAids);

  if (
    strpos($mobsAids, "Feige") !== false
    ||
    strpos($bossAids, "Feige") !== false
    ||
    strpos($mobsAids, "Jäscher") !== false
    ||
    strpos($bossAids, "Jäscher") !== false
  ) {
    $BLUR_CSS = TRUE;
  }

}
?>