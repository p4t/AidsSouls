// Reroll / Reload Page

"use strict";

function reload_page () {
  location.reload();
}
  
function reroll () {
  $(document).ready(function () {
    
      console.log( "reroll::button.clicked" );

      play_audio("aids");

      var myAudio = document.getElementById("audio_aids");
      var timeout; // setTimeout callback
      
      myAudio.onended = function() {
        // location.reload();
        // Remove disabled from button
        switchButton("reroll", "false");
        
        switchButton("rerun", "false");
        
        clearTimeout(timeout);
        console.log("Timeout reset");
        
        console.log( "reroll::ajax.reload" );
        
        // Set text on buttons back to normal manually (hack)
        $("#reroll_button").text("Roll");
        $("#rerun_button").text("Rerun");
        
        $("#aidsAJAX").load("/aidscontent.ajax.php"); // load Aids output
        console.log( "reroll::ajax.reload.finished" );
      };


    // Fail safe if device is not playing audio
      timeout = setTimeout(function(){
        console.log("Audio didn't start playing, refresh on Timeout");
        switchButton("reroll", "false");
        switchButton("rerun", "false");
        $("#aidsAJAX").load("/aidscontent.ajax.php");
      }, 5000);
    
    
  });
}