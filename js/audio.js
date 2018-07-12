// Audio

"use strict";

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
   return img.height != 0;
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
  
  /*
  $("#status").show();
  $("#status").text(src);
  */
  
  console.log(src);
  
  play_audio(src);

} // ENDFUNCTION



/* Play Audio */
  function play_audio (source) {
    
    // set html via jquery
    // $("#element").html("<audio autoplay><source src=\"" + thisSound + "\" type=\"audio/mpeg\"><embed src=\"" + thisSound + "\" hidden=\"true\" autostart=\"true\" /></audio>");
        
    var myAudio = document.getElementById("audio_"+source);
    
    if (source == "shrine") {
      
      if (myAudio.paused) {
        myAudio.play();
        $(".play").html("&#10074;&#10074;"); // Pause Button
      } else {
        myAudio.pause();
        $(".play").html("&#9658;"); // Play button
      }
      
    } else {
      myAudio.play();
    } // END IF SHRINE
    
    
    /*
    // Loop Timer
    // loop only x amount of time (maxPlay) to solve problem with stopping audio when timer is active
    var played = 0;
    var maxPlay = 3;
    
    myAudio.onplay = function() {
      // played counter
      played++;
    };

    // Loop
    $(myAudio).bind("ended", function() {
      if ( // don't loop these audio files
          source !== "dice" &&
          source !== "bier" &&
          source !== "superaids" &&
          source !== "vader" &&
          source !== "aids" &&
          source !== "Biber" &&
          source !== "Katz" &&
          source !== "Pat"
         ) {
        // reset to start point
        myAudio.currentTime = 0;
        if (played < maxPlay) {
          // myAudio.play();
          setTimeout(function() { myAudio.play() }, 2000); // 1250
        } else {
          played = 0;
        }

      }
    });
    */
  
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
  
  /*
  // go through all audio_files array and check if one of those is currently playing and if so, stop it
  for (i = 0; i < audio_files.length; i++) {
    // src = audio_files[i] + ".mp3";
    src = "audio_" + audio_files[i];
    src = document.getElementById(src)
    
    // alert(src);
    // text += cars[i] + "<br>";
    if (src.currentTime > 0) {
      src.pause();
      src.currentTime = 0;
    }
  }
  */

  // Get all audio by reading every audio Tag instead of audio_files array from random_sound()
  for (i = 0; i < all_audio.length; i++) {
    // src = audio_files[i] + ".mp3";
    src = all_audio[i];
    // src = document.getElementById(src)
    
    // alert(src);
    // console.log(src);
    // text += cars[i] + "<br>";
    if (src.currentTime > 0) {
      src.pause();
      src.currentTime = 0;
    }
  }
  


  /*
  var audio_haha      = document.getElementById("audio_haha");
  var audio_yes       = document.getElementById("audio_yes");
  var audio_no        = document.getElementById("audio_no");
  var audio_superaids = document.getElementById("audio_superaids");
  
  if (audio_haha.currentTime > 0) {
    audio_haha.pause();
    audio_haha.currentTime = 0;
  }
  */
}