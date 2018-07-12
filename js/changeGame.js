// Change Game

"use strict";

$(function(){
  // bind change event to select
  $("#selectGame").on("change", function () {
    
    // var game = $(this).val(); // get selected value (not working because of autocomplete)
    var game = document.getElementById("selectGame").value;
    var url = "/?mode=selectGame&game="+game;
    
    console.log("ON CHANGE");
    console.log("GAME: "+game);
    console.log("URL: "+url);
    
    if (url) { // require a URL
        window.location = url; // redirect
    }
    return false;
  });
});