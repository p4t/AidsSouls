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

    if ( $("input#reroll_switch").is(":checked") ) {
      location.reload();
    } else {
      play_audio("aids");

      var myAudio = document.getElementById("audio_aids");
      myAudio.onended = function() {
        location.reload();
      }
    }
  });
}