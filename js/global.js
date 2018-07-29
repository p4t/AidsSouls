// Global JS Functions

"use strict";


// Get active Game
  var _GAME;
  $.ajax({
    async: false,
    type: "GET",
    global: false,
    dataType: "json",
    url: "/activeGame.json",
    success: function (data) {
      _GAME = data;
    }
  });
  
  console.log("GAME: " + _GAME);


function switchButton(source, action) {

  if ( action === "false" ) {
    $( "#"+source+"_button" ).prop( "disabled", false );
    $( "#"+source+"_button" ).removeClass( "disabled" );
  } else {
    $( "#"+source+"_button" ).prop( "disabled", true );
    $( "#"+source+"_button" ).addClass( "disabled" );
  }
  
}


function openBonfire () {
  
  if ( $("#bonfire").css("display") === "none" ) {
    $("#w12").hide();
    $("#rerunroll").hide();
    $("#bonfire").show();
  }
  
}


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



function showRNG () {
  
  /*
  $("#mobsRNG, #bossRNG").toggle();
  $("#mobsRNGNumber, #bossRNGNumber").fadeToggle( "slow", "linear" );
  */
  // console.log("FLIP CLICK");
  
  if ( $( ".dice_wrapper" ).hasClass( "is-flipped" ) ) {
    // console.log("hasClassTRUE");
    $("#mobsRNG, #bossRNG").fadeToggle( "slow", "linear" );
    $("#mobsRNGNumber, #bossRNGNumber").toggle();
    
    $( ".dice_wrapper" ).removeClass( "is-flipped" );
  } else {
    // console.log("hasClassFALSE");
    $("#mobsRNG, #bossRNG").toggle();
    $("#mobsRNGNumber, #bossRNGNumber").fadeToggle( "slow", "linear" );

    $( ".dice_wrapper" ).addClass( "is-flipped" );
  }

}



// Modal (Latest Rolls)
var modal = document.getElementById('myModal');
var modal_content = document.getElementsByClassName("modal-content")[0];
// Get the button that opens the modal
var btn = document.getElementById("myBtn");// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}
// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}
// When User clicks content in Modal
modal_content.onclick = function() {
  modal.style.display = "none";
}
// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) { 
    modal.style.display = "none";
  }
}




/* AJAX JSON Test */
/*
$( document ).ready(function() {
  
  var callback = [];
  $.ajax({
    async: false,
    type: "GET",
    global: false,
    dataType: "json",
    url: "/autocomplete/data.json",
    success: function (data) {
      $.each(data, function (index, value) {
        callback.push(value);
      });
      
      // nest $.each for more than one element
      /*
      $.each(data, function(key, value){
        $.each(value, function(key, value){
          console.log(key, value);
        });
      });
      */

      /*
      console.log( data );
      console.log( "----" );
      console.log( "aids: " + data["Aids"] );
      */
      
      // callback = data;
/*
      callback = data;
    }
  });
  
  console.log("----");
  console.log("callback: " + callback["ds1"][0]["weapons"]);
  
});
*/



/* Aids Ajax Failsafe button */
$( "#aidsAJAXTest" ).click(function() {
  console.log( "#aidsAJAXTest clicked" );
  
  switchButton("reroll", "false");
  switchButton("rerun", "false");
  
  $("#aidsAJAX").load("/aidscontent.ajax.php");
});