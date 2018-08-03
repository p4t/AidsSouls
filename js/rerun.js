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
    
    // random number 1-100
    var rnd       = Math.floor((Math.random() * 100) + 1);
    // Cache jQuery elements
    var $bonfire   = $("#bonfire");
    var $rerunroll = $("#rerunroll");
    var $w12       = $("#w12");
    
    if ( $rerunroll.css("display") === "none" ) {
      $w12.hide();
      $bonfire.hide(); // ???
      $rerunroll.show();      
    } else {
      $rerunroll.hide();
      $bonfire.show();
      
      // stop audio
      stop_audio();
      
      // Remove disabled from button
      switchButton("reroll", "false");
    }
     
    /* DEBUG */
    // rnd = 7;
    
    // check for special output in rnd (1, 7, 77, 99, 100)
    if ( rnd === 7 || rnd === 77 ) {
      $rerunroll.html("<img src='/img/EpicSaxGuy.gif' width='186' height='234' alt='Epic Sax Guy'> <br>" + rnd);        

      if ( $rerunroll.css("display") === "block" ) {
        play_audio("epicsaxguy");
        $bonfire.hide();
        // $("#bonfire").hide();
      }
    } else {
      /* ¯\_(ツ)_/¯ SAD TROMBONE */
      // every rnd value except: 1, 100, 7, 77, 99
      $rerunroll.html("¯\\_(ツ)_/¯ <br>" + rnd);

      if ( $rerunroll.css("display") === "block" ) {        
        // Play Sound
        randomSoundEffect();
        $bonfire.hide();
      }
      
    } // ENDIF

  } // EOF RERUN()