// Audio

"use strict";

// Cache jQuery and global elements
var $reroll_button = $("#reroll_button");
var $rerun_button  = $("#rerun_button");
// var $dice_dropdown = $("#dice_dropdown");

var reroll_button_Orig = "Roll";
var rerun_button_Orig  = "Rerun";

var sound_indicator = "<i class='fas fa-music'></i>"; // music note
// <i class='fas fa-play'></i> // play button
// var $dice_dropdown_Orig  = "🎲";


/* Random Audio */
var audio_files  = [
  "fail",
  "sadtrombone",
  "dolphin",
  "evillaugh",
  "hagay",
  "hahaha(nelson)",
  "sadmusic",
  "sadmusic2",
  "zackgalifianakislaugh",
  "Cheep_1",
  "Cheep_2",
  "IDidNotHitHer",
  "JustAChickenCheep",
  "TearingMeApartLisa",
  "TommyLaugh_1",
  "TommyLaugh_2",
  "TommyLaugh_3",
  "WhyWhyLisa",
  "YouMustBeKidding",
  "200Puls",
  "badesalz1",
  "badesalzWAS",
  "draufdruecken",
  "drecksack",
  "gehtdicheinscheissdreckan",
  "kotzinstreppenhaus",
  "mimimi",
  "mundstuhl",
  "blamage",
  "scheisse",
  "schwarzerbildschirm",
  "wernerflasche",
  "richevanslaugh",
  "alwayssunnybell",
  "flanders",
  "frieza",
  "joker",
  "presi1",
  "presi2",
  "presi3",
  "presi4",
  "presi5",
  "presi6",
  "presi7",
  "rlmwhistle"
];
  
/*
  "werner1",
  "werner2",
  "werner3",
  "werner4",
  "werner5",
  "werner6",
  "werner7",
  "werner8",
  "werner9",
  "werner10",
  "werner11",
  "werner12",
  "werner13",
  "werner14",
  "werner15",
  "werner16",
  "werner17",
  "werner18",
  "werner19",
  "werner20",
  "werner21",
  "werner22",
  "werner23",
  "werner24",
  "werner25",
  "werner26",
  "werner27"

*/

  
  
function ImageExist(url) {
   var img = new Image();
   img.src = url;
   return img.height !== 0;
}  
  

function getRandomInt(min, max) {
  return Math.floor(Math.random() * (max - min + 1)) + min;
}

function randomSoundEffect() {

  // alert(audio_files.length);
  
  console.log(audio_files);
  
  var src = audio_files[getRandomInt(0, audio_files.length - 1)];
  
  // Debug
  // var src = audio_files[48];
  
  // $("img#randimgw12").prop("src", src);
  
  console.log(src);
  
  play_audio(src);

} // ENDFUNCTION



/* Play Audio */
  function play_audio (source) {
        
    var myAudio = document.getElementById("audio_"+source);
    var $play    = $(".play");
    
    if (source === "shrine") {
      
      if (myAudio.paused) {
        myAudio.play();
        $play.html("&#10074;&#10074;"); // Pause Button
        console.log("Bonfire Play");
      } else {
        myAudio.pause();
        $play.html("&#9658;"); // Play button
        console.log("Bonfire Pause");
      }
      
    } else {
      myAudio.play();
      console.log("Event::Audio.started: " + source);
      
      // Show Play button
      $reroll_button.html(sound_indicator);
      $rerun_button.html(sound_indicator);
      // $dice_dropdown.html(sound_indicator);
      
      
      // Disable the button as long as Audio is playing
      switchButton("reroll", "true");
      
      myAudio.onended = function() {
        console.log("Event::Audio.ended");
        
        // Audio ended
        // Remove disabled from button
        switchButton("reroll", "false");
        switchButton("rerun", "false");
        
        // Return original HTML button
        $reroll_button.html(reroll_button_Orig);
        $rerun_button.html(rerun_button_Orig);
        // $dice_dropdown.html($dice_dropdown_Orig);
        
        // show Bonfire
        if ( source !== "dice" && source !== "vader" && source !== "epicsaxguy" && source !== "superaids" ) {openBonfire();}

      };

    } // END IF SHRINE
      
  } // ENDFUNCTION



/* Stop Audio */
function stopAllAudio() {
  var all_audio = document.getElementById("audio").querySelectorAll("audio");
  
	all_audio.forEach(function(audio){
		audio.pause();
	});
}
  

function stop_audio () {
  var all_audio = document.getElementById("audio").querySelectorAll("audio");
  // console.log(all_audio);
  
  
  // global audio_files; @randomSoundEffect()
  var i;
  var src;

  // Get all audio by reading every audio Tag instead of audio_files array from random_sound()
  for (i = 0; i < all_audio.length; i++) {
    // src = audio_files[i] + ".mp3";
    src = all_audio[i];

    if (src.currentTime > 0) {
      src.pause();
      src.currentTime = 0;
      
      // Return original HTML button
      $reroll_button.html(reroll_button_Orig);
      $rerun_button.html(rerun_button_Orig);
      
      console.log("Event::Audio.stopped.manually");
    }
  }

}