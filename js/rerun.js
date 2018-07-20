// Rerun

"use strict";

  /*
  * Roll dice 1-100
  * 1, 100  = Vader (skip turn)
  * 7, 77   = Epic Sax Guy (new chance after death)
  * 99      = Superaids (2 items of aids instead of one)
  * Remains = ¯\_(ツ)_/¯ (no rerun)
  */
  function rerun() {
    
    var rnd = Math.floor((Math.random() * 100) + 1);
    
    if ( $("#rerunroll").css("display") === "none" ) {
      $("#w12").hide();
      $("#bonfire").hide(); // ???
      $("#rerunroll").show();      
    } else {
      $("#rerunroll").hide();
      $("#bonfire").show();
      
      // stop audio
      stop_audio();
      
      // Remove disabled from button
      $( "#reroll_button" ).prop( "disabled", false );
      $( "#reroll_button" ).removeClass( "disabled" );
    }
     
    /* DEBUG */
    // rnd = 7;
    
    // check for special output in rnd (1, 7, 77, 99, 100)
    if ( rnd == 7 || rnd == 77 ) {
      $("#rerunroll").html("<img src='/img/EpicSaxGuy.gif' width='186' height='234' alt='Epic Sax Guy'> <br>" + rnd);        

      if ( $("#rerunroll").css("display") === "block" ) {
        play_audio("epicsaxguy");
        $("#bonfire").hide();
        // $("#bonfire").hide();
      }
    } else {
      /* ¯\_(ツ)_/¯ SAD TROMBONE */
      // every rnd value except: 1, 100, 7, 77, 99
      $("#rerunroll").html("¯\\_(ツ)_/¯ <br>" + rnd);

      if ( $("#rerunroll").css("display") === "block" ) {
        // play_audio("haha");
        // play_audio("fail");
        
        // Play Sound
        randomSoundEffect();
        $("#bonfire").hide();
      }

        
        // VADER
        /* } else if (rnd == 1 || rnd == 100) {
        $("#rerunroll").html("<img src='/img/vader.jpg' width='323' height='203' alt='Vader'> <br>" + rnd);

        if ( $("#rerunroll").css("display") === "block" ) {
          play_audio("vader");
          $("#bonfire").hide();
        }  
        
        // SUPERAIDS
      } else if (rnd == 99) {
        $("#rerunroll").html("SUPERAIDS<br>" + rnd);
      
        if ( $("#rerunroll").css("display") === "block" ) { 
          play_audio("superaids");
          $("#bonfire").hide();
          // $("#rerunroll").load("superaids.inc.php"); // Ajax load superaids php
        }
      }
      */
      
    } // ENDIF
    
    /* always uncheck checkbox "rerun_only" on every click if bonfire is hidden */
    /*
    if ( $("input#rerun_switch").is(":checked") && $("#bonfire").css("display") == "block" ) {
      $("input#rerun_switch").prop("checked", false);
      
      $("#rerun_switch_button").text("Run"); // Fix Text on the button
    }
    */
  } // EOF RERUN()