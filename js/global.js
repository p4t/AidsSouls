// Global JS Functions

"use strict";


// Get active Game
  /*
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
  */
  
  console.log("GAME: " + _GAME);


function switchButton(source, action) {

  // Cache jQuery objects
  var $source_button = $( "#"+source+"_button" );
  
  if ( action === "false" ) {    
    $source_button.prop( "disabled", false );
    $source_button.removeClass( "disabled" );
  } else {
    $source_button.prop( "disabled", true );
    $source_button.addClass( "disabled" );
  }
  
}


function openBonfire () {
  
  // Cache jQuery objects
  var $bonfire = $("#bonfire");
  
  if ( $bonfire.css("display") === "none" ) {
    $("#w12").hide();
    $("#rerunroll").hide();
    $bonfire.show();
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
  
  // Cache jQuery objects
  var $dice_wrapper = $( ".dice_wrapper" );
  var $rng = $("#mobsRNG, #bossRNG");
  var $rng_number = $("#mobsRNGNumber, #bossRNGNumber");
  
  if ( $dice_wrapper.hasClass( "is-flipped" ) ) {
    // console.log("hasClassTRUE");
    $rng.fadeToggle( "slow", "linear" );
    $rng_number.toggle();
    
    $dice_wrapper.removeClass( "is-flipped" );
  } else {
    // console.log("hasClassFALSE");
    $rng.toggle();
    $rng_number.fadeToggle( "slow", "linear" );

    $dice_wrapper.addClass( "is-flipped" );
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
  
  // switch buttons
  switchButton("reroll", "false");
  switchButton("rerun", "false");
  
  // Set text on buttons back to normal manually (hack)
  $("#reroll_button").text("Roll");
  $("#rerun_button").text("Rerun");
  
  $("#aidsAJAX").load("/aidscontent.ajax.php");
});



/* Ajax loading spinner */
  //init: automatic monitoring ajax events
  var loading = $.loading({
    background : "",
    // minTime    : 2000,
    imgPath    : "/img/spinner.svg",
    imgWidth   : "80px",
    imgHeight  : "80px",
    tip        : ""
  });


/* Preload big images */
/*
$( document ).ready(function() {

  $.preloadImages = function() {
    for (var i = 0; i < arguments.length; i++) {
      $("<img />").attr("src", arguments[i]);
    }
  }

  $.preloadImages("/img/EpicSaxGuy.gif", "/img/curse.png", "/img/vader.jpg", "/dice/icons/parry.gif");

});
*/


/* Animated spinner on first page load */
$( document ).ready(function() {

  $(".se-pre-con").fadeOut();

});