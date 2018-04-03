<?php
// Info
// phpinfo() = 5.3.10
  
// Lib
require_once("config.db.php");
require_once("functions.inc.php");

// DB Hack
// include_once("aids.ajax.php");
// include_once("jquery_post.php");
// include_once("edit.ajax.php");
// include_once("todo.ajax.php");

// include_once("superaids.inc.php");

/*
//////////////// COMBINE getRNG() and getAidsByRNG and return as array with 4 values
*/
// Get max dice value for mt_rand()
$RNG        = getRNG();
$mobsRNG    = $RNG[0];
$bossRNG    = $RNG[1];

$flasks     = 13;
$weaponIMG  = "<img src=\"/img/weapon_icon.png\" width=\"30\" height=\"30\" alt=\"Weapon\">"; // 41, 40
// Replace dice with weapon icon?
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// DEBUG
/*
$mobsRNG = 5;
$bossRNG = 5;
*/

// Get Aids from mobs boss tables 
$Aids     = getAidsByRNG($mobsRNG, $bossRNG);
$mobsAids = $Aids[0];
$bossAids = $Aids[1];

// Random Weapon
$randomWeapon = randomWeapon();

// Get Todo List from DB
$stmt = $pdo->prepare( "SELECT * FROM todo" );
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);

$todoID   = $row["ID"];
$todoText = $row["todoText"];

// Write aids rolls into DB
saveRolls($mobsAids, $bossAids); // Table/Output in edit.php
?>

<!doctype html>
<html lang="de">
<head>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes, user-scalable=yes">
  
<title>\[T]/</title>
<base href="http://aids.gyros-mit-zaziki.de">

<link rel="stylesheet" href="/css/layout.css" type="text/css" media="screen">
<link rel="stylesheet" href="/css/flex.css" type="text/css" media="screen">
<link rel="stylesheet" href="/css/button.css" type="text/css" media="screen">
<link rel="stylesheet" href="/css/table.css" type="text/css" media="screen">
<link rel="stylesheet" href="/css/form.css" type="text/css" media="screen">
<link rel="stylesheet" href="/css/messages.css" type="text/css" media="screen">
<link rel="stylesheet" href="/css/dice_animations.css" type="text/css" media="screen">
<link rel="stylesheet" href="/css/mobile.css" type="text/css" media="screen">

<!-- Balloon Tooltip -->
<link rel="stylesheet" href="/css/balloon.css">

<link rel="apple-touch-icon" sizes="180x180" href="/img/favico/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="/img/favico/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/img/favico/favicon-16x16.png">
<link rel="manifest" href="/manifest.json">
<link rel="mask-icon" href="/img/favico/safari-pinned-tab.svg" color="#3f292b">
  
<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Marcellus+SC" rel="stylesheet">

<meta name="theme-color" content="#3f292b">
<meta name="msapplication-TileColor" content="#3f292b"> 
<meta name="apple-mobile-web-app-status-bar-style" content="#3f292b">

<meta name="mobile-web-app-capable" content="yes">
  
<meta name="google" content="notranslate">
<meta name="application-name" content="Aids Souls">
<meta name="description" content="Roll dice to get AIDS">
<meta name="robots" content="noindex, nofollow">
<meta name="googlebot" content="noindex, nofollow">
<meta name="google" content="nositelinkssearchbox">

<!-- jQuery -->
<script src="/js/jquery-3.3.1.min.js"></script>
  

<!-- Show Modal on hover -->
<script>
function showModal() {
  var modal = document.getElementById('myModal');
  if ( modal.style.display = "none" ) {
    modal.style.display = "block";  
  } else {
    modal.style.display = "none";
  }
  
}
</script>
 
<!-- jQuery Ajax inline edit AIDS -->
<script>  
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
            setTimeout(function(){message_status.hide()},30000); // 3000
			   }
          
        });
    });
});
</script>
  
<!-- jQuery Ajax inline edit TODO -->
<script>
$(document).ready(function () {
    // acknowledgement message
      var message_status = $("#status");

      $("div[contenteditable=true]").blur(function(){
      // $("#todo").blur(function(){
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
</script>

<!-- jQuery Ajax Form -->
<script>
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
</script>
  
<!-- Checkbox Switch Text -->
<script>
$( document ).ready(function() {

  // W20
  $("#dice_switch").change(function () {
    if ( $("#dice_switch").is(":checked") ) {
      // "checked"
      // alert("DEBUG");
      $("#dice_switch_button").text("W20");

      return;
    }
    // "unchecked"
    // alert("DEBUG");
    $("#dice_switch_button").text("W12");
  });
  
  // W12, W20
  $("#rerun_switch").change(function () {
    if ( $("#rerun_switch").is(":checked") ) {
      // "checked"
      // alert("DEBUG");
      $("#rerun_switch_button").text("Rerun?");

      return;
    }
    // "unchecked"
    // alert("DEBUG");
    $("#rerun_switch_button").text("Run");
  });
  

  // Reroll
  $("#reroll_switch").change(function () {
    if ( $("#reroll_switch").is(":checked") ) {
      // "checked"
      // alert("DEBUG");
      $("#reroll_switch_button").text("-((()))");

      return;
    }
    // "unchecked"
    // alert("DEBUG");
    $("#reroll_switch_button").text("Roll");
  });
  
  
  
});
</script>
  
<!-- W12, W20 -->
<script>
// Random image out of 12
var images_w6  = ["1.png",
                  "2.png",
                  "3.png",
                  "4.png",
                  "5.png",
                  "6.png"
                  ];
  
var images_w12  = ["1.png",
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
                  "12.png"
                  ];

var images_w20  = ["1.png",
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
                  "13.png",
                  "14.png",
                  "15.png",
                  "16.png",
                  "17.png",
                  "18.png",
                  "19.png",
                  "20.png"
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

// Checkbox
if ( $("input#dice_switch").is(":checked") ) {
  images = images_w20;
  $("#dice_h2").text("W20");
} else {
  images = images_w12;
  $("#dice_h2").text("W12");
}
  
  
  var src = "/dice/" + images[getRandomInt(0, images.length - 1)];
  $("img#randimgw12").prop("src", src);
  
  /*
  var src = images[getRandomInt(0, images.length - 1)];
  $("#randimgw12").text(src);
  */
  
  /* always uncheck checkbox "rerun_only" on every click if bonfire is hidden */
  /*
  if ( $("input#dice_switch").is(":checked") && $("#bonfire").css("display") == "block" ) {
  $("input#dice_switch").prop("checked", false);
  }
  */

} // ENDFUNCTION
</script>

<!-- Rerun -->
<script>
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
      
        if ( $("#rerunroll").css("display") === "block" ) { 
          play_audio("superaids");
          $("#bonfire").hide();
          // $("#rerunroll").load("superaids.inc.php"); // Ajax load superaids php
        }

      }
      
    } // ENDIF
    
    /* always uncheck checkbox "rerun_only" on every click if bonfire is hidden */
    if ( $("input#rerun_switch").is(":checked") && $("#bonfire").css("display") == "block" ) {
      $("input#rerun_switch").prop("checked", false);
      
      $("#rerun_switch_button").text("Run"); // Fix Text on the button
    }
    
  } // EOF RERUN()
</script> 
 
<!-- Reload Page -->
<script>
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
</script>  

<!-- Play Audio -->
<script>
  function play_audio (source) {
    var myAudio = document.getElementById("audio_"+source);

    if (source = "shrine") {
      
      if (myAudio.paused) {
        myAudio.play();
        $(".play").html("&#10074;&#10074;");
      } else {
        myAudio.pause();
        $(".play").html("&#9658;");
      }
      
    } else {
      myAudio.play();
    }
  
  } // ENDFUNCTION
</script>

<!-- Stop Audio --> 
<script>
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
</script>  

<!-- [contenteditable] change font on edit -->

</head>

<body spellcheck="false">
      
<!-- Wrapper -->
<div class="container">

<!-- Header -->
<header>
  <!-- 
  img src="/img/ds1_logo.png" alt="Dark Souls II Logo" width="630" height="80">
  <img src="/img/ds2_logo.png" alt="Dark Souls II Logo" width="630" height="80">
  <img src="/img/ds1remaster_logo.png" alt="Dark Souls II Logo" width="630" height="80">
  -->
    <img src="/img/ds3_logo.png" alt="Dark Souls III Logo" width="661" height="80">
  <h4>mit verschärftem AIDS</h4>  
</header>


<?php
  // Check Missing Dice
  checkMissingDice();
?>

  
<a id="Roll"></a>

<div class="content">
<div class="aidscontent">
  
<!-- AIDS: MOBS, MIDDLE, BOSS -->
<div id="flex-container-aids">

  <!-- MOBS left -->
  <div class="flex-item-aids-left">
    <h2>Mobs</h2>
    <div class="bounceInDownRotate">
      <div class="dice_wrapper">
        <div class="dice_wrapper-font">
          <?=$mobsRNG?>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Bonfire -->
  <div id="bonfire" class="flex-item-aids-middle flicker-in-1" onClick="play_audio('shrine')">
    <div class="itemsContainer">
      <div class="image"> <a href="#">  <img src="/img/WeirdTepidChital-max-1mb.gif" width="172" height="236" alt="" /> </a></div>
      <div class="play">&#9658; </div><!-- &#9646; -->
    </div>
  </div>
  
  <!-- W12/W20 output -->
  <div id="w12" class="flex-item-aids-middle" style="display: none;">
    <h2 id="dice_h2">W12</h2>
    <img src="/dice/0.png" class="dice flip-scale-up-diag-1" id="randimgw12" width="100" height="100" alt="Dice 0">
    <!-- <div id="randimgw12" style="height: 100px"></div> -->
  </div>
  
  <!-- rerunroll -->
  <div class="flex-item-aids-middle" id="rerunroll" style="display: none;"></div>

  <!-- BOSS right -->
  <div class="flex-item-aids-right">
    <h2>Boss</h2>
    <div class="bounceInDownRotate">
      <div class="dice_wrapper">
        <div class="dice_wrapper-font">
          <?=$bossRNG?>
        </div>
      </div>
    </div>
  </div>
  
</div><!-- EOF flex-container-aids -->

  
<!-- OUTPUT ROLLED AIDS -->
<div id="flex-container-aids-text">
  <div>
    <span class="aidsText tracking-in-expand">
      <?=$mobsAids?>
    </span>
  </div>

  <!--
  <div id="randomWeapon">RandomWeapon()</div>
  -->

  <div>
    <span class="aidsText tracking-in-expand">
      <?=$bossAids?>
    </span>
  </div>
</div><!-- EOF flex-container-aids -->
  
  
<!-- BUTTONS -->
<div id="flex-container-roll">
  
  <!-- Reroll / Reload page -->
  <div class="flex-item-button">

    <button class="button" onClick="reroll()" data-balloon="<?=getLatestRoll()?>" data-balloon-pos="right">
      <span id="reroll_switch_button">Roll</span>
    </button>

    <br>
    
    <label for="reroll_switch" class="switch" data-balloon="Checked: Ohne (((Aids)))" data-balloon-pos="down">
      <input type="checkbox" id="reroll_switch" onClick="play_audio('toggle')">
      <span class="slider"></span>
    </label>
    
  </div>
  
  <!-- W12 -->
  <div class="flex-item-button">

    <button class="button" onClick="pickimg()">
      <span id="dice_switch_button">W12</span>
    </button>
    
    <br>
    
    <label for="dice_switch" class="switch" data-balloon="Wechsel zwischen w12 und w20" data-balloon-pos="down">
      <input type="checkbox" id="dice_switch" onClick="play_audio('toggle')">
      <span class="slider"></span>
    </label>
        
  </div>
  
  
  <!-- Rerun? -->
  <div class="flex-item-button">

    <button class="button" onClick="rerun()">
      <span id="rerun_switch_button">Run</span>
    </button>
  
    <br>
    
    <label for="rerun_switch" class="switch" data-balloon="Checked: Nur Rerun (Epic Sax Guy, ¯\_(ツ)_/¯)" data-balloon-pos="down">
      <input type="checkbox" id="rerun_switch" onClick="play_audio('toggle')">
      <span class="slider"></span>
    </label>
    
  </div>
</div> 

</div><!-- EOF aidscontent -->

  
<hr>

  
<h5 id="Aids">Aids</h5>
<!-- LIST OF ALL THE AIDS: MOBS BOSS, WEAPONS --> 
<div class="aidsListing">
  <div id="flex-container-ajax">
    <?php
    include_once("aids.ajax.php")
    ?>
  </div><!-- .flex-container-ajax -->
  
  <!-- jQuery Form: Add Mobs, Boss, Weapons -->
  <form id="form" method="post" onsubmit="return false">
    <div id="flex-container-ajax-form">
      
      <!-- Mobs -->
      <div class="flex-item-ajax-form">
        <label for="ajax_mobs">
          +&nbsp;<input type="text" id="ajax_mobs" value="" size="15" autocomplete="off" maxlength="32" placeholder="Mobs">
        </label>
      </div>
      <!-- Boss -->
      <div class="flex-item-ajax-form">
        <label for="ajax_boss">
          +&nbsp;<input type="text" id="ajax_boss" value="" size="15" autocomplete="off" maxlength="32" placeholder="Boss">
        </label>
      </div>
      <!-- Weapons -->
      <div class="flex-item-ajax-form">
        <label for="ajax_weapons">
          +&nbsp;<input type="text" id="ajax_weapons" value="" size="15" autocomplete="off" maxlength="32" placeholder="Waffen">
        </label>
      </div>

    </div>

    <div id="ajax-form-button">
      <label for="btn">
        <button id="btn" class="button_small">+</button>
      </label>
    </div>
  </form>
  
</div><!-- EOF flex-container-aidsListing -->
  
  
<hr>
  
<?php
/*
///////////// FOR KILLS: make evrything inline edit and change joker format to bosseskilled-jokerspent=jokerleftover to asily edit
*/
?>

<h5 id="Kills">Kills</h5>
<!-- Kills Table -->
<div class="killedBosses">
  <table>
    <thead>
      <tr>
        <th>Kaschber</th>
        <th>Kills</th>
        <th>Joker</th>
        <th>Boss</th>
      </tr>
    </thead>
    <tbody>
           
<?php
/* Get Boss Kills from SQL, display table */
$stmt = $pdo->prepare("SELECT * FROM kills");
$stmt->execute();
      
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) :
  $joker = $row["joker"] - $row["spent"];
?>
  <tr id="id:<?=$row["ID"]?>:name:<?=$row["name"]?>" onClick="play_audio('<?=$row["name"]?>')"><!-- contenteditable="true" -->
    <td class="emoji">
      <a href="edit?mode=kills&ID=<?=$row["ID"]?>" target="_blank" data-balloon="<?=$row["name"]?>" data-balloon-pos="up"><?=replaceNameWithEmoji( $row["name"] )?></a>
    </td>

    <td>
      <a href="edit?mode=kills&ID=<?=$row["ID"]?>" target="_blank" data-balloon="<?=$row["joker"]?> gekillte Bosse" data-balloon-pos="up"><?=numberToTally( $row["joker"] )?></a>
    </td>

    <td>
      <a href="edit?mode=kills&ID=<?=$row["ID"]?>" target="_blank" data-balloon="<?=$joker?> Joker übrig" data-balloon-pos="up"><?=replaceIntWithFlasks( $joker )?></a>
    </td>

    <td>
      <a href="edit?mode=kills&ID=<?=$row["ID"]?>" target="_blank" data-balloon="<?=replaceBrWithComma( $row["bossNames"] )?>" data-balloon-pos="up" data-balloon-length="medium"><?=replaceCheeseWithEmoji( nl2br($row["bossNames"]) )?></a>
    </td>
  </tr>
<?php
ENDWHILE
?>
 
    </tbody>
  </table>
</div><!-- EOF killedBosses -->

  
  
<hr>  
  
  
<h5 id="Todo">Todo</h5>
<!-- Todo Table -->
<div id="todo" contenteditable="true" data-balloon="2x Enter für Zeilenumbruch" data-balloon-pos="up">
  <?=$todoText?>
</div>

  
<!-- Ajax Success Msg fixed -->
<div id="status">&nbsp;</div>

<!-- FOOTER -->
<hr>
<footer>
  <nav>
    <a href="#" id="myBtn">Zuletzt gewürfelt</a> |
    <a href="/edit" target="_blank">Edit</a>
  </nav>
</footer>
<hr>
  

</div><!-- EOF Content -->
</div><!-- EOF Container -->
  
  
<!-- AUDIO -->
<div id="audio">
  <audio id="audio_Biber"           src="/audio/biber.mp3"></audio>
  <audio id="audio_Katz"            src="/audio/meow.mp3"></audio>
  <audio id="audio_Pat"             src="/audio/Pat.mp3"></audio>
  <audio id="audio_haha"            src="/audio/SadTrombone.mp3"></audio>
  <audio id="audio_yes"             src="/audio/EpicSaxGuy.mp3"></audio>
  <audio id="audio_no"              src="/audio/nooo.ogg"></audio>
  <audio id="audio_dice"            src="/audio/dice.wav"></audio>
  <audio id="audio_aids"            src="/audio/aids.mp3"></audio>
  <audio id="audio_superaids"       src="/audio/superaids.mp3"></audio>
  <audio id="audio_bonfirerefresh"  src="/audio/DarkSoulsBonfireRefreshSoundEffect.ogg"></audio>
  <audio id="audio_toggle"          src="/audio/toggle.mp3"></audio>
  <!--
  <audio id="audio_shrine"          src="/audio/ds3_firelinkshrine.mp3"></audio>
  <audio id="audio_shrine"          src="/audio/DarkSoulsBonfireSoundEffect(cropped).ogg"></audio>
  <audio id="audio_shrine"          src="/audio/DarkSoulsBonfireSoundEffect(cropped)LowerVolume.ogg"></audio>
  -->
  <audio id="audio_shrine"          src="/audio/DS1_Firelink_Shrine.mp3"></audio>
</div>

  

<!-- LATEST ROLLS MODAL POPUP -->
<!-- Trigger/Open The Modal -->
<!-- <button id="myBtn" class="button">latestRolls()</button> -->
<!-- The Modal -->
<div id="myModal" class="modal animate">
  <div class="modal-content">
    <span class="close">&times;</span>
    <div class="message">
      <div class="message_line">
        <?php
        $data = $pdo->query("SELECT date, IP, mobs, boss FROM rolls WHERE mobs != '' AND boss != '' ORDER BY ID DESC LIMIT 1, 4")->fetchAll(PDO::FETCH_ASSOC);
        foreach ($data as $value) :
        ?>
        <div class="row">
          <div class="col"><?=$value["mobs"]?></div>
          <div class="col"><?=$value["boss"]?></div>
          <div class="col"><?=formatDate($value["date"])?></div>
        </div>
        <?php
        ENDFOREACH
        ?> 
      </div>
    </div>
  </div>
</div><!--  EOF MODAL -->
<script>
// Get the modal
var modal = document.getElementById('myModal');
  
var modal_content = document.getElementsByClassName("modal-content")[0];

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
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
</script>    
  
  
</body>
</html>