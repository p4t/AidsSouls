  /*
  * Roll dice 1-100
  * 1, 100  = Vader (skip turn)
  * 7, 77   = Epic Sax Guy (new chance after death)
  * 99      = Superaids (2 items of aids instead of one)
  * Remains = ¯\_(ツ)_/¯ (no rerun)
  */
  function rerun() {

    var rnd         = Math.floor((Math.random() * 100) + 1)
    //var rerunroll   = document.getElementById("rerunroll");
    //var bonfire     = document.getElementById("bonfire");

    //var w12         = document.getElementById("w12");
    
    /*
    var rerunroll   = $("#rerunroll").get(0);
    var bonfire     = $("#bonfire")[0];
    */
    
    if ( $("#rerunroll").css("display") === "none" ) {
      $("#w12").hide();
      $("#bonfire").hide(); // ????????????????????? WIESO? FFS?
      $("#rerunroll").show();
    } else {
      $("#rerunroll").hide();
      $("#bonfire").show();
      
      // stop audio
      stop_audio(); // "haha"/sad trombome only atm
    }
     
    /* DEBUG */
    // rnd = 99;
    
    // If checkbox for rerun only (no vader, superaids) is checked
    // check for special output in rnd (1, 7, 77, 99, 100)
    if ( 
        ( $("input#rerun_switch").is(":checked") && rnd != 7 && rnd != 77 ) // checkbox checked, rnd is not 7 or 77
        ||
        ( $("input#rerun_switch").not(":checked") && rnd != 1 && rnd != 7 && rnd != 77 && rnd != 100 && rnd !=99 ) // checkbox unchecked and no special (vader etc)
      )
    {
      
      /* ¯\_(ツ)_/¯ SAD TROMBONE */
      // every rnd value except: 1, 100, 7, 77, 99
      $("#rerunroll").html("¯\\_(ツ)_/¯ <br>" + rnd);
  
      if ( $("#rerunroll").css("display") === "block" ) {
        play_audio("haha");
        $("#bonfire").hide();
      }
      
    } else {
      /* Checkbox rerun_only is not checked and no standard output ie 55, 20. NOT 1, 7, 77, 99, 100 */
      
      /* EPIC SAX GUY */
      if (rnd == 7 || rnd == 77) {
        $("#rerunroll").html("<img src='/img/EpicSaxGuy.gif' width='186' height='234' alt='Epic Sax Guy'> <br>" + rnd);        
        
        if ( $("#rerunroll").css("display") === "block" ) {
          play_audio("yes");
          $("#bonfire").hide();
          $("#bonfire").hide();
          // modal popup
          var modal = document.getElementById('myModal');
          // modal.style.display = "block";
        }
        
        // VADER
      } /* else if (rnd == 1 || rnd == 100) {
        $("#rerunroll").html("<img src='/img/vader.jpg' width='323' height='203' alt='Vader'> <br>" + rnd);

        if ( $("#rerunroll").css("display") === "block" ) {
          play_audio("no");
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
    if ( $("input#rerun_switch").is(":checked") && $("#bonfire").css("display") == "block" ) {
      $("input#rerun_switch").prop("checked", false);
      
      $("#rerun_switch_button").text("Run"); // Fix Text on the button
    }
    
  } // EOF RERUN()
