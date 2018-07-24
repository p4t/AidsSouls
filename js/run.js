// Run

"use strict";

function replaceAidsWithX () {
  $("#mobsRNG").html("&times;");
  $("#bossRNG").html("&times;");
  $("#mobsAids").html("&times;");
  $("#bossAids").html("&times;");
}

function run() {

  var run_rnd = Math.floor((Math.random() * 100) + 1);
  
  // debug
  // run_rnd = 1;
  console.log("run_rnd:" + run_rnd);
  
  // Display run_rnd on hover button
  $("#rerun_switch_button").prop("title", run_rnd);
  // $("#rerun_button").prop("data-balloon", run_rnd);
    
  // VADER
  if (run_rnd === 1 || run_rnd === 100) {
    if ( $("#bonfire").css("display") === "block" ) {
      $("#bonfire").hide();
      $("#rerunroll").show();
      $("#rerunroll").html("<img src='/img/vader.jpg' width='323' height='203' alt='Vader'> <br>" + run_rnd);
      // Handle Dice and text
      replaceAidsWithX();
      play_audio("vader");
    }
  
  // Curse
  } else if (run_rnd === 66) {
    $("#bonfire").hide();
    $("#rerunroll").show();
    $("#rerunroll").html("<img src='/img/curse.png' width='384' height='320' alt='Curse Basilisk'> <br>");
    play_audio("superaids");
    
  // SUPERAIDS
  } else if (run_rnd === 99) {
    $("#bonfire").hide();
    $("#rerunroll").show();
    $("#rerunroll").html("SUPERAIDS <br>" + run_rnd);
    play_audio("superaids");

    // $("#rerunroll").load("superaids.inc.php"); // Ajax load superaids php
  } else {
    // NIX
  }


}

$( document ).ready(function() {
  
  // run(); // don't use run() on initial page load anymore
  
});