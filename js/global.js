// Global JS Functions

"use strict";

function switchButton(source, action) {
/*
  $( "#reroll_button" ).prop( "disabled", false );
  $( "#reroll_button" ).removeClass( "disabled" );
  ----
  $( "#reroll_button" ).prop( "disabled", true );
  $( "#reroll_button" ).addClass( "disabled" );
*/
  if ( action === "false" ) {
    $( "#"+source+"_button" ).prop( "disabled", false );
    $( "#"+source+"_button" ).removeClass( "disabled" );
  } else {
    $( "#"+source+"_button" ).prop( "disabled", true );
    $( "#"+source+"_button" ).addClass( "disabled" );
  }
  
}