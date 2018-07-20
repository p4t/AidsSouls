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
        $( "#reroll_button" ).prop( "disabled", false );
        $( "#reroll_button" ).removeClass( "disabled" );
        
        console.log( "reroll::ajax.reload" );
        $("#aidsAJAX").load("/aidscontent.ajax.php"); // load Aids output
        console.log( "reroll::ajax.reload.finished" );
      };
    //}
  });
}

// ALTERNATIVELY:
/*
$( "#aidsAJAXTest" ).click(function() {
  console.log( "#aidsAJAXTest clicked" );
  $("#aidsAJAX").load("/aidscontent.ajax.php"); // load Aids output
});
*/