// W6, W12, W20, W30, Stats

"use strict";

// Get stats depending on active _GAME
// var stats = <?php //include("stats.inc.php");?>;

// Get stats
/*
var stats;
$.ajax({
  async: false,
  type: "GET",
  global: false,
  dataType: "json",
  url: "/stats.inc.php",
  success: function (data) {
    stats = data;
  }
});
*/


  

function getRandomInt(min, max) {
  if ( $("#dice_dropdown option:selected").text() === "W6" ) {max = 6;}
  return Math.floor(Math.random() * (max - min + 1)) + min;
}

function pickimg() {
  
  
  // Random number out of max 30
  var dice = [
    "1","2","3","4","5","6","7","8","9","10",
    "11","12","13","14","15","16","17","18","19","20",
    "21","22","23","24","25","26","27","28","29","30"
  ];
  
  console.log("stats: " + stats);
  
  // Cache jQuery elements
  var $bonfire   = $("#bonfire");
  var $rerunroll = $("#rerunroll");
  var $w12       = $("#w12");
  
  var $dice_dropdown = $("#dice_dropdown");
  var $randomDiceOut = $("#randomDiceOut");
  var $dice_h2       = $("#dice_h2");
  
  if ( $w12.css("display") === "none" ) {

    $w12.show();
    $bonfire.hide();

    // close div of rerun() if shown
    $rerunroll.hide();
    // stop audio of rerun
    stop_audio();
    // play audio
    play_audio("dice");

  } else {
    // Disable hiding w12, showing bonfire when clicking on dice
    // and add in jQuery animation for dice on click
    play_audio("dice");
    $randomDiceOut.addClass( "flip-scale-up-diag-1" ).one("webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend", function(){
        $(this).removeClass( "flip-scale-up-diag-1" );
    });
    
  }

 

/* Select */
  var diceRND;
  var stat_css = false;
  // W6
  if ( $dice_dropdown.val() === "W1" ) { // if ( $("#dice_dropdown option:selected").text() == "W6" ) {
  diceRND = stats;
  $dice_h2.text("Stats");
  
  // set var to let function know a Stat was rolled
  stat_css = true;
  
} else if ( $dice_dropdown.val() === "W6" ) {
  diceRND = dice.slice(0, 6);
  $dice_h2.html("W6");
  
  // W12
} else if ( $dice_dropdown.val() === "W12" ) {
  diceRND = dice.slice(0, 12);
  $dice_h2.text("W12");
  
  // W20
} else if ( $dice_dropdown.val() === "W20" ) {
  diceRND = dice.slice(0, 20);
  $dice_h2.text("W20");
  
  // W30
} else if ( $dice_dropdown.val() === "W30" ) {
  diceRND = dice.slice(0, 30);
  $dice_h2.text("W30");
}


  var src = diceRND[getRandomInt(0, diceRND.length - 1)];
  
  // if stat instead of rnd dice add class to enhance dice img class #randomDiceOut
  // also remove class for the dice
  if ( stat_css === true ) {
    
    // console.log("STATS");
      
    $randomDiceOut.addClass( "stat" );
        
    // console.log("_GAME: " + _GAME);
    
    $randomDiceOut.html( " <div><img src='/img/stats/"+_GAME+"/"+src+".png' alt='"+src+"'></div><div>" + src + "</div> ");
  } else {
    
    // console.log("DICE");
    
    // remove .stat to show dice symbol bg again
    if ( $randomDiceOut.hasClass("stat") ) {
      $randomDiceOut.removeClass( "stat" );
    }
    
    $randomDiceOut.text(src);
  } 
  
  // Debug
  console.log("diceRND: " + diceRND);
  console.log("src: " + src);
  
} // ENDFUNCTION