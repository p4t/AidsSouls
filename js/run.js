// Run

"use strict";

function replaceAidsWithX() {
  $("#mobsRNG, #bossRNG, #mobsAids, #bossAids, #mobsRNGNumber, #bossRNGNumber").html("&times;");
}

function run() {
  
  // random number 1-100
  var run_rnd   = Math.floor((Math.random() * 100) + 1);
  // Cache jQuery elements
  var $bonfire   = $("#bonfire");
  var $rerunroll = $("#rerunroll");
  
  // debug
  // run_rnd = 1;
  console.log("run_rnd:" + run_rnd);
  
  // Display run_rnd on hover button
  $("#rerun_switch_button").prop("title", run_rnd);
    
  // VADER
  if (run_rnd === 1 || run_rnd === 100) {
    if ( $bonfire.css("display") === "block" ) {
      $bonfire.hide();
      $rerunroll.show().html("<img src='/img/vader.jpg' width='323' height='203' alt='Vader'> <br>" + run_rnd);
      // Handle Dice and text
      replaceAidsWithX();
      // Kevin Spacey BG
      $("html").css("background-image", "url(/img/bg/kevin.jpg)");
      play_audio("vader");
    }
  
  // Curse
  } else if (run_rnd === 66) {
    $bonfire.hide();
    $rerunroll.show().html("<img src='/img/curse.png' width='384' height='320' alt='Curse Basilisk'> <br>");
    play_audio("superaids");
    
  // SUPERAIDS
  } else if (run_rnd === 99) {
    $bonfire.hide();
    $rerunroll.show().html("SUPERAIDS <br>" + run_rnd);
    play_audio("superaids");

    // $("#rerunroll").load("superaids.inc.php"); // Ajax load superaids php
  } else {
    // NIX
  }

}

/*
$( document ).ready(function() {
  
  // run(); // don't use run() on initial page load anymore
  
});
*/