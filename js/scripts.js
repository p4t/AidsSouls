/* Bonfire Refresh sound on site load/reload */

/*
$(document).ready(function() {
  play_audio("bonfirerefresh");
});
*/

  
/*
$(document).ready(function() {
$("#audio_bonfirerefresh").get(0).play();
});
    */
  
  

  
/* Prevent new line break on enter key*/
/*
$("#flex-container-ajax").on("keydown", function(e) {
  if (e.which == 13 && e.shiftKey == false) {
    // Prevent insertion of a return
    // You could do other things here, for example
    // focus on the next field
    // alert("NLB");
    return false;
  }
});  
*/



  

/*
* jQuery Ajax inline edit AIDS
*/ 
$(document).ready(function () {
	// acknowledgement message
    var message_status = $("#status");
  
  // check text length
  /*
    if ($("#field").html().length > 20) {
    short_text = $("#field").html().substr(0, 20);
    $("#field").html(short_text + "...");
    }
  */
  
    $("li[contenteditable=true]").blur(function(){
        var field = $(this).attr("id") ;
        var value = $(this).text() ;
        $.post("edit.ajax.php" , field + "=" + value, function(data){
          
          if (data != "") {
            message_status.show();
            message_status.text(data);
            // hide the message
            setTimeout(function(){message_status.hide()},3000); // 3000
			   }
          
        });
    });
});

 




/*
* jQuery Ajax inline edit TODO
*/ 
$(document).ready(function () {
    // acknowledgement message
      var message_status = $("#status");

      $("div[contenteditable=true]").blur(function(){
          var field = $(this).attr("id");

        // NLB Hack
        var updatedHTML = $(this).html();   
        var replacement = updatedHTML.trim()
                .replace(/<br(\s*)\/*>/ig, '\n')
                .replace(/<[p|div]\s/ig, '\n$0')
                .replace(/(<([^>]+)>)/ig,"");
        var value = replacement;

          // var value = $(this).text();
          // var value = $(this).text();
          // New line hack
          // var value = console.log($(this).innerText);
          $.post("todo.ajax.php" , field + "=" + value, function(data){
            
            if (data != "") {
              message_status.show();
              message_status.text(data);
              // hide the message
              setTimeout(function(){message_status.hide()},3000); // 3000
           }
           

          });
      });
  });






/*
* jQuery Ajax Form
*/ 
$(document).ready(function () {
  
  // clear all inputs on focus loss
  /*
  $("input").blur(function(){
      // alert("This input field has lost its focus.");
    $(this).val('');
  });
  */
  
  // on button click or enter
  $("#btn").click(function () {
    var message_status = $("#status");
    
    var vmobs     = $("input#ajax_mobs").val(); // mobs input field
    var vboss     = $("input#ajax_boss").val(); // boss field
    var vweapons  = $("input#ajax_weapons").val(); // weapons field
  
    if ($.trim(vmobs) == "" && $.trim(vboss) == "" && $.trim(vweapons) == "") {
      //alert("Mindestens 1 Feld ausfüllen!");
      
      // $("#status").replaceWith( "Mindestens 1 Feld ausfüllen!" );
      // $("#success").text("Bitte ausfüllen!" + "<br>");
      message_status.show();
      message_status.text("Mindestens 1 Feld ausfüllen!");
      // hide the message
      setTimeout(function(){message_status.hide()},3000); // 3000
      
      discombobulate();
    } else {
      $.post("jquery_post.php", // Required URL of the page on server
        { // Data Sending With Request To Server
          mobs: vmobs,
          boss: vboss,
          weapons: vweapons
        },
        function (response, status) { // Required Callback Function
          // alert("*----Received Data----*\n\nResponse : " + response + "\n\nStatus : " + status); //"response" receives - whatever written in echo of above PHP script.
          // alert(response);
          // $("#success").append( "<p>Erfolg!</p>" );
          // $("#success").append( response + "<br>"); // show success msg for every added entry
          // $("#success").replaceWith( response ); // show success msg fonce
          // $("#status").append( response ); // show success msg fonce
          // $("#status").append( "Hinzugefügt." );
          // alert(status);
      
          if (status != "") {
            message_status.show();
            message_status.text("Hinzugefügt.");
            // hide the message
            setTimeout(function(){message_status.hide()},3000); // 3000
         }
        
        
          $("#form")[0].reset();
          $("#flex-container-ajax").load("aids.ajax.php"); // load weapons list again for ajax bamboozle
        });
    } // ENDIF
    
  });
});

  



/*
* Toggles
*/ 
  function bonfire_toggle (mode) {
    // mode: on/off
    var bonfire     = document.getElementById("bonfire");
    
    if (mode === "show") bonfire.style.display = "block";
    else if (mode === "hide") bonfire.style.display = "none";
  }
  
  function toggle (source, mode) {
    var source     = document.getElementById(source);
    
    if (mode === "show") source.style.display = "block";
    else if (mode === "hide") source.style.display = "none";
  }
  
  function show (source) {
    var source     = document.getElementById(source);
    source.style.display = "block";
  }
  
  function hide (source) {
    var source     = document.getElementById(source);
    source.style.display = "none";
  }
  
  




  
/*
* W12
*/ 
// Random image out of 12  
var images = ["1.png",
              "2.png",
              "3.png",
              "4.png",
              "5.png",
              "6.png",
              "7.png",
              "8.png",
              "9.png",
              "10.png",
              "11.png",
              "12.png",
             ];

function getRandomInt(min, max) {
  return Math.floor(Math.random() * (max - min + 1)) + min;
}

function pickimg() {

  if ( $("#w12").css("display") == "none" ) {

    $("#w12").show();
    $("#bonfire").hide();

    // close div of rerun() if shown
    $("#rerunroll").hide();
    // play audio
    play_audio("dice");

  } else {
    $("#w12").hide();
    $("#bonfire").show();
  }

  var src = "/dice/" + images[getRandomInt(0, images.length - 1)];
  $("img#randimgw12").prop("src", src)

} // ENDFUNCTION








/*
* Rerun
*
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
  // rnd = 7;

  // If checkbox for rerun only (no vader, superaids) is checked
  // check for special output in rnd (1, 7, 77, 99, 100)
  if ( 
      ( $("input#rerun_only").is(":checked") && rnd != 7 && rnd != 77 ) // checkbox checked, rnd is not 7 or 77
      ||
      ( $("input#rerun_only").not(":checked") && rnd != 1 && rnd != 7 && rnd != 77 && rnd != 100 && rnd !=99 ) // checkbox unchecked and no special (vader etc)
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
      }

      /* VADER */
    } else if (rnd == 1 || rnd == 100) {
      $("#rerunroll").html("<img src='/img/vader.jpg' width='323' height='203' alt='Vader'> <br>" + rnd);

      if ( $("#rerunroll").css("display") === "block" ) {
        play_audio("no");
        $("#bonfire").hide();
      }  

      /* SUPERAIDS */
    } else if (rnd == 99) {
      $("#rerunroll").html("SUPERAIDS<br>" + rnd);
        
      // Ajax load superaids.inc.php and get random Aids from DB
      /*
      if ( $("#rerunroll").css("display") === "block" ) { 
        play_audio("superaids");
        $("#bonfire").hide();
        $("#rerunroll").load("superaids.inc.php"); // Ajax load superaids php
      }
      */

    }

  } // ENDIF

  /* always uncheck checkbox "rerun_only" on every click if bonfire is hidden */
  if ( $("input#rerun_only").is(":checked") && $("#bonfire").css("display") == "block" ) {
    $("input#rerun_only").prop("checked", false);
  }

} // EOF RERUN()
 
 
/*
* Reload Page
*/ 
function reload_page () {
  location.reload();
}
  
function reroll () {
  play_audio("aids");
  
  var myAudio = document.getElementById("audio_aids");
  
  myAudio.onended = function() {
      // alert("AIDS");
      location.reload();
    }
  
  // setTimeout(function() { reload_page(); }, 1800); // time to play rich evans aids (default: 1800)
  
}
  

/*
* Play Audio
*/ 
  function play_audio (source) {
    var myAudio = document.getElementById("audio_"+source);

    if (source = "shrine") {
      
      if (myAudio.paused) {
        myAudio.play();
      } else {
        myAudio.pause();
      }
      
    } else {
      myAudio.play();
    }
  
  } // ENDFUNCTION




/*
* Stop Audio
*/ 
function stop_audio () {
  var audio_haha      = document.getElementById("audio_haha");
  var audio_yes       = document.getElementById("audio_yes");
  var audio_no        = document.getElementById("audio_no");
  var audio_superaids = document.getElementById("audio_superaids");
  
  if (audio_haha.currentTime > 0) {
    audio_haha.pause();
    audio_haha.currentTime = 0;
  }
  /*
  stop_audio("haha");
  stop_audio("yes");
  stop_audio("no");
  stop_audio("superaids");
  */
}