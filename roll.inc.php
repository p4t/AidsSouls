<?php
// Make sure nothing is rolled on firt page load
// Only roll aids etc when $firstPageLoad (TRUE @index.php) has been set to FALSE in aidscontent.ajax.php
if ( $firstPageLoad != "TRUE" ) {
  
  // Get random number
  $RNG        = getRNG();
  $mobsRNG    = $RNG[0];
  $bossRNG    = $RNG[1];

  // Get random number for NG+
  $RNGNGP        = getRNG();
  $mobsRNGNGP    = $RNGNGP[0];
  $bossRNGNGP    = $RNGNGP[1];

  // DEBUG
  // $mobsRNG = 15;
  // $bossRNG = 5;

  // Debug vars from _GET[]
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

  // Set special Aids CSS variable TRUE
  // @aids.css.php
  if ( _CSSAIDS == "TRUE" ) { // Only if global is enabled

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

  } // ENDIF

} else { // Ajax Roll Button was NOT used, page was initially loaded
  
  // $placeholder = "❌";
  // $placeholder = "R";
  // $placeholder = "🎲";
  $placeholder = "";
  
  $mobsAids = $placeholder;
  $bossAids = $placeholder;

  $mobsRNG = $placeholder;
  $bossRNG = $placeholder;

  // Get aids from mobs boss tables for NG+
  $mobsAidsNGP = $placeholder;
  $bossAidsNGP = $placeholder;

  // Output for dice-wrapper display
  $mobsRNG_Output = $placeholder;
  $bossRNG_Output = $placeholder;
  
} // ENDIF
?>