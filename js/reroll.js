// Reroll / Reload Page

"use strict";

function reload_page () {
  location.reload();
}
  
function reroll () {
  $(document).ready(function () {
    /*
    play_audio("aids");
    var myAudio = document.getElementById("audio_aids");

    myAudio.onended = function() {
      location.reload();
    }
    */

    // setTimeout(function() { reload_page(); }, 1800); // time to play rich evans aids (default: 1800)



    //if ( $("input#reroll_switch").is(":checked") ) {
      //location.reload();
    //} else {
      
      console.log( "reroll::button.clicked" );

      play_audio("aids");

      var myAudio = document.getElementById("audio_aids");
      var timeout; // setTimeout callback
      
      // Check if Audio is being played 
      /*
        if (myAudio.duration > 0 && !myAudio.paused) {

            //Its playing...do your job

        } else {

            //Not playing...maybe paused, stopped or never played.

        }
      */
      myAudio.onended = function() {
        // location.reload();
        // Remove disabled from button
        /*
        $( "#reroll_button" ).prop( "disabled", false );
        $( "#reroll_button" ).removeClass( "disabled" );
        */
        switchButton("reroll", "false");
        
        /*
        $( "#rerun_button" ).prop( "disabled", false );
        $( "#rerun_button" ).removeClass( "disabled" );
        */
        switchButton("rerun", "false");
        
        clearTimeout(timeout);
        console.log("Timeout reset");
        
        console.log( "reroll::ajax.reload" );
        $("#aidsAJAX").load("/aidscontent.ajax.php"); // load Aids output
        console.log( "reroll::ajax.reload.finished" );
      };
    //}
    
      /* Check if Audio started */
      /*
      if (myAudio.played.length) {
        console.log("Audio Device working correctly");// This media has already been played
      } else {
        //if ( $('#rerun_button').is(':enabled') ) {
          console.log("Audio doesn't start playing, .load() content");// Never
          switchButton("reroll", "false");
          switchButton("rerun", "false");
          $("#aidsAJAX").load("/aidscontent.ajax.php");
        //}
      }
      */

    // Fail safe if device is not playing audio
      timeout = setTimeout(function(){
        console.log("Audio didn't start playing, refresh on Timeout");
        switchButton("reroll", "false");
        switchButton("rerun", "false");
        $("#aidsAJAX").load("/aidscontent.ajax.php");
      }, 5000);
    
    
  });
}

// ALTERNATIVELY:
/*
$( "#aidsAJAXTest" ).click(function() {
  console.log( "#aidsAJAXTest clicked" );
  $("#aidsAJAX").load("/aidscontent.ajax.php"); // load Aids output
});
*/