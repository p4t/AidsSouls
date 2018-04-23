<?php
// Lib
require_once("config.db.php");
require_once("functions.inc.php");

// Handle Logout
if (
    (!empty($_GET["action"])) &&
    ($_GET["action"] == "logout") &&
    ($_SESSION["valid"] == true)
   ) {
  logout();
}

// DB Hack
// include_once("aids.ajax.php");
// include_once("jquery_post.php");
// include_once("edit.ajax.php");
// include_once("todo.ajax.php");
// include_once("superaids.inc.php");

// include_once("/css/login.css");


// Get max dice value for mt_rand()
$RNG        = getRNG();
$mobsRNG    = $RNG[0];
$bossRNG    = $RNG[1];

$flasks     = FLASKS;
$weaponIMG  = "<img src=\"/img/weapon_icon.png\" width=\"30\" height=\"30\" alt=\"Weapon\">"; // 41, 40

// DEBUG
$mobsRNG = 22;
$bossRNG = 17;


// Get Aids from mobs boss tables 
$Aids     = getAidsByRNG($mobsRNG, $bossRNG);
$mobsAids = $Aids[0];
$bossAids = $Aids[1];

// Debug output
/*
echo "<pre>";

echo "MobsRNG: " . $mobsRNG;
echo "<br>";
echo "BossRNG: " . $bossRNG;
echo "<br>";
echo "<br>";
echo "MobsAids: " . $mobsAids;
echo "<br>";
echo "BossAids: " . $bossAids;

echo "</pre>";
*/

// $aidsArray = array("Jäscher", "Feige");

$mobsRNG_Output = replaceDiceWithSymbol ($mobsAids, $mobsRNG);
$bossRNG_Output = replaceDiceWithSymbol ($bossAids, $bossRNG);



/*
// Handle Shots
if ( $mobsAids == "Jäscher" || $mobsAids == "Feige" ) { // if (strcasecmp($var1, $var2) == 0) {
  // RNG # for balloon-tip
  $mobsRNGNR   = $mobsRNG;
  
  $newMobsAids = getShotsAidsByRNG("mobs");

  $mobsAids = $mobsAids . ":&nbsp;" . $newMobsAids;
  
  // JS Hack
  $shots = TRUE;
  
}

if ( $bossAids == "Jäscher" || $bossAids == "Feige") {
  // RNG # for balloon-tip
  $bossRNGNR   = $bossRNG;

  $newBossAids = getShotsAidsByRNG("boss");

  $bossAids = $bossAids . ":&nbsp;" . $newBossAids;
  
  // JS Hack
  $shots = TRUE;
}
*/

// Save $boss/mobsRNG number value in var to output as balloon-tip if the dice number is replaced by image
/*
$c_mobs = $mobsRNGNR ?? $mobsRNG;
$c_boss = $bossRNGNR ?? $bossRNG;
*/



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

/* LOGIN */
/*
unset($error);

if ( (!empty($_POST["username"])) && (!empty($_POST["password"])) ) {

  $username = trim($_POST["username"]);
  $password = trim($_POST["password"]);
  
  $error = login ($username, $password);
    
} // ENDIF
if ( (!empty($_SESSION["username"])) && ($_SESSION["valid"] == TRUE) ) {
*/

/*
echo "mobsrngout: " . $mobsRNG_Output;
echo "<br><br>";
echo "bossrngout: " . $bossRNG_Output;
*/
?>

<!doctype html>
<html lang="de">
<head>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
  
<title>\[T]/</title>
<base href="http://ds.fahrzeugatelier.de">
  
<link rel="stylesheet" href="/css/layout.css" type="text/css" media="screen">
<link rel="stylesheet" href="/css/flex.css" type="text/css" media="screen">
<link rel="stylesheet" href="/css/button.css" type="text/css" media="screen">
<link rel="stylesheet" href="/css/table.css" type="text/css" media="screen">
<link rel="stylesheet" href="/css/form.css" type="text/css" media="screen">
<!-- <link rel="stylesheet" href="/css/login.css" type="text/css" media="screen"> -->
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- jQuery Corner Plugin -->
<!-- https://github.com/malsup/corner -->
<script src="/js/jquery.corner.js"></script>


<!-- Open Bonfire -->
<script>
function openBonfire () {
  if ( $("#bonfire").css("display") == "none" ) {
    $("#w12").hide();
    $("#rerunroll").hide();
    $("#bonfire").show();
  }
}
</script>

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
  // Select
  $("select#dice_dropdown").change(function() {
    if ($(this).val() == "W6") {
      $("#dice_switch_button").text("W6");
      return;
     }        
  });
  $("select[id='dice_dropdown']").change(function() {
    if ($(this).val() == "W12") {
      $("#dice_switch_button").text("W12");
      return;
     }        
  });
  $("select[id='dice_dropdown']").change(function() {
    if ($(this).val() == "W20") {
      $("#dice_switch_button").text("W20");
      return;
     }        
  });
  $("select[id='dice_dropdown']").change(function() {
    if ($(this).val() == "W30") {
      $("#dice_switch_button").text("W30");
      return;
     }        
  });

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
  
<!-- W6, W12, W20, W30 -->
<script>
// Random image out of 12
var images_w6  = [
  "1.png",
  "2.png",
  "3.png",
  "4.png",
  "5.png",
  "6.png"
];
  
var images_w12  = [
  "1.png",
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

var images_w20  = [
  "1.png",
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

var images_w30  = [
  "1.png",
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
  "20.png",
  "21.png",
  "22.png",
  "23.png",
  "24.png",
  "25.png",
  "26.png",
  "27.png",
  "28.png",
  "29.png",
  "30.png"
];

function getRandomInt(min, max) {
  return Math.floor(Math.random() * (max - min + 1)) + min;
}

function pickimg(w = 0) {

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

/* Checkbox*/
if ( $("input#dice_switch").is(":checked") ) {
  images = images_w20;
  $("#dice_h2").text("W20");
} else {
  images = images_w12;
  $("#dice_h2").text("W12");
}
 

/* Select */
  // W6
if ( $("#dice_dropdown option:selected").text() == "W6" ) {
  images = images_w6;
  $("#dice_h2").text("W6");
  
  // W12
} else if ( $("#dice_dropdown option:selected").text() == "W12" ) {
  images = images_w12;
  $("#dice_h2").text("W12");
  
  // W20
} else if ( $("#dice_dropdown option:selected").text() == "W20" ) {
  images = images_w20;
  $("#dice_h2").text("W20");
  
  // W30
} else if ( $("#dice_dropdown option:selected").text() == "W30" ) {
  images = images_w30;
  $("#dice_h2").text("W30");
}


/* Bootstrap Dropdown */
if ( w == 6 ) {
  images = images_w6;
  $("#dice_h2").text("W6");
  
} else if ( w == 12 ) {
  images = images_w12;
  $("#dice_h2").text("W12");
  
} else if ( w == 20 ) {
  images = images_w20;
  $("#dice_h2").text("W20");
  
} else if ( w == 30 ) {
  images = images_w30;
  $("#dice_h2").text("W30");
}

  
  
  var src = "/dice/" + images[getRandomInt(0, images.length - 1)];
  $("img#randimgw12").prop("src", src);
  
  /*
  var src = images[getRandomInt(0, images.length - 1)];
  $("#randimgw12").text(src);
  */
  
  // Debug
  /*
  $("#status").show();
  $("#status").text(images);
  */
  
  /* always uncheck checkbox "rerun_only" on every click if bonfire is hidden */
  /*
  if ( $("input#dice_switch").is(":checked") && $("#bonfire").css("display") == "block" ) {
  $("input#dice_switch").prop("checked", false);
  }
  */

} // ENDFUNCTION
</script>

<!-- Run -->
<script>
function replaceAidsWithX () {
  $("#mobsRNG").html("&times;");
  $("#bossRNG").html("&times;");
  $("#mobsAids").html("&times;");
  $("#bossAids").html("&times;");
}
  
$( document ).ready(function() {
  // var run_rnd = Math.floor((Math.random() * 100) + 1);
  var run_rnd = Math.floor((Math.random() * 100) + 1);
  
  /* DEBUG */
  // run_rnd = 1;
  <?php
  if ( (!empty($_GET["debug"])) && ($_GET["debug"] == "vader") ) {
  ?>
  run_rnd = 1;
  <?php
  } else if ( (!empty($_GET["debug"])) && ($_GET["debug"] == "superaids") ) {
  ?>
  run_rnd = 99;
  <?php
  }
  ?>
  
  <?php
  if ( !empty($_GET["rnd"]) && is_numeric($_GET["rnd"]) ) {
  ?>
  run_rnd = "<?=$_GET["rnd"]?>";
  <?php
  }
  ?>
  
  // Display run_rnd on hover button
  $("#rerun_switch_button").prop("title", run_rnd);
  // $("#rerun_switch_button").prop("data-balloon", run_rnd);
  $("#rerun_button").prop("data-balloon", run_rnd);
  
  // alert(run_rnd);
  // $("#jsstatus").show();
  // $("#jsstatus").text("run_rnd: " + run_rnd);
  
  
  // VADER
  if (run_rnd == 1 || run_rnd == 100) {
    if ( $("#bonfire").css("display") === "block" ) {
      $("#bonfire").hide();
      $("#rerunroll").show();
      $("#rerunroll").html("<img src='/img/vader.jpg' width='323' height='203' alt='Vader'> <br>" + run_rnd);
      // Handle Dice and text
      replaceAidsWithX();
      play_audio("vader");
    }
      
    
  // SUPERAIDS
  } else if (run_rnd == 99) {
    $("#bonfire").hide();
    $("#rerunroll").show();
    $("#rerunroll").html("SUPERAIDS<br>" + run_rnd);
    play_audio("superaids");

    // $("#rerunroll").load("superaids.inc.php"); // Ajax load superaids php
  } else {
    // NIX
  }
  
  
  
});
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

<!-- Random Audio -->
<script>
// Random image out of 12
var audio_files  = [
  "fail",
  "sadtrombone",
  "dolphin",
  "evillaugh",
  "hagay",
  "hahaha(nelson)",
  "sadmusic",
  "sadmusic2",
  "zackgalifianakislaugh",
  "Cheep_1",
  "Cheep_2",
  "IDidNotHitHer",
  "JustAChickenCheep",
  "TearingMeApartLisa",
  "TommyLaugh_1",
  "TommyLaugh_2",
  "TommyLaugh_3",
  "WhyWhyLisa",
  "YouMustBeKidding",
  "200Puls",
  "badesalz1",
  "badesalzWAS",
  "draufdruecken",
  "drecksack",
  "gehtdicheinscheissdreckan",
  "kotzinstreppenhaus",
  "mimimi",
  "mundstuhl",
  "blamage",
  "scheisse",
  "schwarzerbildschirm",
  "wernerflasche",
  "richevanslaugh",
  "alwayssunnybell"
];

  
  
function ImageExist(url) {
   var img = new Image();
   img.src = url;
   return img.height != 0;
}  
  

function getRandomInt(min, max) {
  return Math.floor(Math.random() * (max - min + 1)) + min;
}

function randomSoundEffect() {

  // alert(audio_files.length);
  
  var src = audio_files[getRandomInt(0, audio_files.length - 1)];
  
  // Debug
  // var src = audio_files[33];
  
  // $("img#randimgw12").prop("src", src);
  
  /*
  $("#status").show();
  $("#status").text(src);
  */
  
  play_audio(src);

} // ENDFUNCTION
</script>

<!-- Play Audio -->
<script>
  function play_audio (source) {
    var myAudio = document.getElementById("audio_"+source);
    
    if (source == "shrine") {
      
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
    
    // Loop
    $(myAudio).bind("ended", function()  {
      if (source !== "dice" && source !== "bier" && source !== "superaids" && source !== "vader" ) {
        // Debug
        // alert(source);
        myAudio.currentTime = 0;
        myAudio.play();
      }
    });
  
  } // ENDFUNCTION
</script>

<!-- Stop Audio --> 
<script>
function stop_audio () {
  
  // global audio_files; @randomSoundEffect()
  var i;
  var src;
  
  // go through all audio_files array and check if one of those is currently playing and if so, stop it
  for (i = 0; i < audio_files.length; i++) {
    // src = audio_files[i] + ".mp3";
    src = "audio_" + audio_files[i];
    src = document.getElementById(src)
    
    // alert(src);
    // text += cars[i] + "<br>";
    if (src.currentTime > 0) {
      src.pause();
      src.currentTime = 0;
    }
  }
  

  /*
  var audio_haha      = document.getElementById("audio_haha");
  var audio_yes       = document.getElementById("audio_yes");
  var audio_no        = document.getElementById("audio_no");
  var audio_superaids = document.getElementById("audio_superaids");
  
  if (audio_haha.currentTime > 0) {
    audio_haha.pause();
    audio_haha.currentTime = 0;
  }
  */
}
</script>  

<!-- SHOTS -->
<?php
if ( !empty($shots) && $shots == TRUE  ) {
?>  
<script>
// alert("BIER");
$( document ).ready(function() {
    play_audio("bier");
});
</script>
<?php  
}
?>
  
  
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

<!-- Check for missing Dice -->
<?php
  // Check Missing Dice
  checkMissingDice();
?>


<div class="content">
<div class="aidscontent" id="jQueryCorner">
  
<!-- AIDS: MOBS, MIDDLE, BOSS -->
<div id="flex-container-aids">

  <!-- MOBS left -->
  <div class="flex-item-aids-left" data-balloon="<?=$mobsRNG?>" data-balloon-pos="up">
    <h2>Mobs</h2>
    <div class="bounceInDownRotate">
      <div class="dice_wrapper">
        <div class="dice_wrapper-font">
          <span id="mobsRNG"><?=$mobsRNG_Output?></span>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Bonfire -->
  <div id="bonfire" class="flex-item-aids-middle flicker-in-1 user-select" onClick="play_audio('shrine')">
    <div class="itemsContainer">
      <div class="image"> <a href="#">  <img src="/img/WeirdTepidChital-max-1mb.gif" width="172" height="236" alt="" /> </a></div>
      <div class="play">&#9658; </div><!-- &#9646; -->
    </div>
  </div>
  
  <!-- W12/W20 output -->
  <div id="w12" class="flex-item-aids-middle" style="display: none;" onclick="openBonfire()">
    <h2 id="dice_h2">W12</h2>
    <img src="/dice/0.png" class="dice flip-scale-up-diag-1" id="randimgw12" width="100" height="100" alt="Dice">
    <!-- <div id="randimgw12" style="height: 100px"></div> -->
  </div>
  
  <!-- rerunroll -->
  <div class="flex-item-aids-middle" id="rerunroll" style="display: none;"></div>

  <!-- BOSS right -->
  <div class="flex-item-aids-right" data-balloon="<?=$bossRNG?>" data-balloon-pos="up">
    <h2>Boss</h2>
    <div class="bounceInDownRotate">
      <div class="dice_wrapper">
        <div class="dice_wrapper-font">
          <span id="bossRNG"><?=$bossRNG_Output?></span>
        </div>
      </div>
    </div>
  </div>
  
</div><!-- EOF flex-container-aids -->

  
<!-- OUTPUT ROLLED AIDS -->
<div id="flex-container-aids-text">
  <div>
    <div class="aidsText tracking-in-expand">
      <span id="mobsAids"><?=$mobsAids?></span>
    </div>
  </div>

  
  <!-- <div id="randomWeapon">php$randomWeapon</div> -->
  

  <div>
    <div class="aidsText tracking-in-expand">
      <span id="bossAids"><?=$bossAids?></span>
    </div>
  </div>
</div><!-- EOF flex-container-aids -->

  
<!-- BUTTONS -->
<div id="flex-container-roll">
  
  <!-- Reroll / Reload page -->
  <div class="flex-item-button">

    <button class="button" onClick="reroll()" data-balloon="<?=getLatestRoll()?>" data-balloon-pos="right">
      <span id="reroll_switch_button">Roll</span>
    </button>
    
    <!--
    <label for="reroll_switch" class="switch" data-balloon="Checked: Ohne (((Aids)))" data-balloon-pos="down">
      <input type="checkbox" id="reroll_switch" onClick="play_audio('toggle')">
      <span class="slider"></span>
    </label>
    -->
    
  </div>
  
  <!-- W12 -->
  <div class="flex-item-button">
    
    <!--
    <button class="button" onClick="pickimg()">
      <span id="dice_switch_button">W12</span>
    </button>
    -->
    
    <!--
    <select id="dice_dropdown" name="dice_dropdown">
      <option value="W6">W6</option>
      <option value="W12" selected>W12</option>
      <option value="W20">W20</option>
      <option value="W30">W30</option>
    </select>
    -->
    
    <select id="dice_dropdown" name="dice_dropdown" class="custom-select dice_dropdown" placeholder="🎲">
      <option value="W6">W6</option>
      <option value="W12" selected>W12</option>
      <option value="W20">W20</option>
      <option value="W30">W30</option>
    </select>
 
<!-- Custom Select jQuery -->
<script>
$(".custom-select").each(function() {
  var classes = $(this).attr("class"),
      id      = $(this).attr("id"),
      name    = $(this).attr("name");
  var template =  '<div class="' + classes + '">';
      template += '<span class="custom-select-trigger">' + $(this).attr("placeholder") + '</span>';
      template += '<div class="custom-options">';
      $(this).find("option").each(function() {
        template += '<span class="custom-option ' + $(this).attr("class") + '" data-value="' + $(this).attr("value") + '">' + $(this).html() + '</span>';
      });
  template += '</div></div>';
  
  $(this).wrap('<div class="custom-select-wrapper"></div>');
  $(this).hide();
  $(this).after(template);
});
$(".custom-option:first-of-type").hover(function() {
  $(this).parents(".custom-options").addClass("option-hover");
}, function() {
  $(this).parents(".custom-options").removeClass("option-hover");
});
$(".custom-select-trigger").on("click", function() {
  $('html').one('click',function() {
    $(".custom-select").removeClass("opened");
    
    // Fix Text on Button
    $("#dice_switch_button").text($("#dice_dropdown").val());
    pickimg();
    // Check if some other function shows bonfire
    
  });
  $(this).parents(".custom-select").toggleClass("opened");
  
  // show bonfire on select click to show dropdown options
  $("#rerunroll").hide();
  $("#w12").hide();
  $("#bonfire").show();
  // pickimg();
  
  event.stopPropagation();
});
$(".custom-option").on("click", function() {
  $(this).parents(".custom-select-wrapper").find("select").val($(this).data("value"));
  $(this).parents(".custom-options").find(".custom-option").removeClass("selection");
  $(this).addClass("selection");
  $(this).parents(".custom-select").removeClass("opened");
  $(this).parents(".custom-select").find(".custom-select-trigger").text($(this).text());
});
</script>

      
    
    <!--
    <label for="dice_switch" class="switch" data-balloon="Wechsel zwischen w12 und w20" data-balloon-pos="down">
      <input type="checkbox" id="dice_switch" onClick="play_audio('toggle')">
      <span class="slider"></span>
    </label>
    -->
        
  </div>
  
  
  <!-- Rerun? -->
  <div class="flex-item-button">

    <button class="button" onClick="rerun()" id="rerun_button" title="" data-balloon="" data-balloon-pos="left">
      <span id="rerun_switch_button">Rerun?</span>
    </button>
  
    <!--
    <label for="rerun_switch" class="switch" data-balloon="Checked: Nur Rerun (Epic Sax Guy, ¯\_(ツ)_/¯)" data-balloon-pos="down">
      <input type="checkbox" id="rerun_switch" onClick="play_audio('toggle')">
      <span class="slider"></span>
    </label>
    -->
    
  </div>

  
</div><!-- EOF #flex-container-roll-->

<!-- Debug Status Msg -->
<div id="jsstatus">&nbsp;</div>

</div><!-- EOF aidscontent -->
  

<script>
  // $("#jQueryCorner").corner("sculpt");
</script>

  
<div id="status_song">&nbsp;</div>
  
  
<hr>

  
<h5 id="Aids">Aids</h5>
<!-- LIST OF ALL THE AIDS: MOBS BOSS, WEAPONS --> 

<form id="form" method="post" onsubmit="return false">

<div class="aidsListing">
  <div id="flex-container-ajax">
    <?php
    include_once("aids.ajax.php")
    ?>
  </div><!-- .flex-container-ajax -->
  
  <!-- jQuery Form: Add Mobs, Boss, Weapons -->
  <!-- <form id="form" method="post" onsubmit="return false"> -->
    <div id="flex-container-ajax-form">
      
      <!-- Mobs -->
      <!--
      <div class="flex-item-ajax-form">
        <label for="ajax_mobs">
          +&nbsp;<input type="text" id="ajax_mobs" value="" size="15" autocomplete="off" maxlength="32" placeholder="Mobs">
        </label>
      </div>
      -->
      
      <!-- Boss -->
      <!--
      <div class="flex-item-ajax-form">
        <label for="ajax_boss">
          +&nbsp;<input type="text" id="ajax_boss" value="" size="15" autocomplete="off" maxlength="32" placeholder="Boss">
        </label>
      </div>
      -->
      
      <!-- Weapons -->
      <!--
      <div class="flex-item-ajax-form">
        <label for="ajax_weapons">
          +&nbsp;<input type="text" id="ajax_weapons" value="" size="15" autocomplete="off" maxlength="32" placeholder="Waffen">
        </label>
      </div>
      -->
      
    </div>

    <div id="ajax-form-button">
      <label for="btn">
        <button id="btn" class="button_small">+</button>
      </label>
    </div>
  
</div><!-- EOF flex-container-aidsListing -->

</form>
  
  
<hr>
  

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
    <span>
      User: <?=$_SESSION["username"]?> |
    </span>
    <a href="/?action=logout">Logout</a> |
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
  <audio id="audio_sadtrombone"     src="/audio/SadTrombone.mp3"></audio>
  <audio id="audio_epicsaxguy"      src="/audio/EpicSaxGuy.mp3"></audio>
  <audio id="audio_vader"           src="/audio/nooo.ogg"></audio>
  <audio id="audio_dice"            src="/audio/dice.wav"></audio>
  <audio id="audio_aids"            src="/audio/aids.mp3"></audio>
  <audio id="audio_superaids"       src="/audio/superaids.mp3"></audio>
  <audio id="audio_bonfirerefresh"  src="/audio/DarkSoulsBonfireRefreshSoundEffect.ogg"></audio>
  <audio id="audio_toggle"          src="/audio/toggle.mp3"></audio>
  <audio id="audio_fail"            src="/audio/fail.mp3"></audio>
  <audio id="audio_bier"            src="/audio/bier.mp3"></audio>
  <audio id="audio_richevanslaugh"  src="/audio/richevanslaugh.mp3"></audio>
  
  
  <!-- Scheissendreck -->
  <audio id="audio_dolphin"               src="/audio/dolphin.mp3"></audio>
  <audio id="audio_evillaugh"             src="/audio/evillaugh.mp3"></audio>
  <audio id="audio_hagay"                 src="/audio/hagay.mp3"></audio>
  <audio id="audio_hahaha(nelson)"        src="/audio/hahaha(nelson).mp3"></audio>
  <audio id="audio_sadmusic"              src="/audio/sadmusic.mp3"></audio>
  <audio id="audio_sadmusic2"             src="/audio/sadmusic2.mp3"></audio>
  <audio id="audio_zackgalifianakislaugh" src="/audio/zackgalifianakislaugh.mp3"></audio>
  <audio id="audio_alwayssunnybell"       src="/audio/alwayssunnybell.mp3"></audio>
  

  <!-- The Room -->
  <audio id="audio_Cheep_1"             src="/audio/TheRoom/Cheep_1.mp3"></audio>
  <audio id="audio_Cheep_2"             src="/audio/TheRoom/Cheep_2.mp3"></audio>
  <audio id="audio_IDidNotHitHer"       src="/audio/TheRoom/IDidNotHitHer.mp3"></audio>
  <audio id="audio_JustAChickenCheep"   src="/audio/TheRoom/JustAChickenCheep.mp3"></audio>
  <audio id="audio_TearingMeApartLisa"  src="/audio/TheRoom/TearingMeApartLisa.mp3"></audio>
  <audio id="audio_TommyLaugh_1"        src="/audio/TheRoom/TommyLaugh_1.mp3"></audio>
  <audio id="audio_TommyLaugh_2"        src="/audio/TheRoom/TommyLaugh_2.mp3"></audio>
  <audio id="audio_TommyLaugh_3"        src="/audio/TheRoom/TommyLaugh_3.mp3"></audio>
  <audio id="audio_WhyWhyLisa"          src="/audio/TheRoom/WhyWhyLisa.mp3"></audio>
  <audio id="audio_YouMustBeKidding"    src="/audio/TheRoom/YouMustBeKidding.mp3"></audio>
  
  
  <!-- WoWQuote -->
  <audio id="audio_200Puls"                   src="/audio/WoWQuote/200Puls.mp3"></audio>
  <audio id="audio_badesalz1"                 src="/audio/WoWQuote/badesalz1.mp3"></audio>
  <audio id="audio_badesalzWAS"               src="/audio/WoWQuote/badesalzWAS.mp3"></audio>
  <audio id="audio_draufdruecken"             src="/audio/WoWQuote/draufdruecken.mp3"></audio>
  <audio id="audio_drecksack"                 src="/audio/WoWQuote/drecksack.mp3"></audio>
  <audio id="audio_gehtdicheinscheissdreckan" src="/audio/WoWQuote/gehtdicheinscheissdreckan.mp3"></audio>
  <audio id="audio_kotzinstreppenhaus"        src="/audio/WoWQuote/kotzinstreppenhaus.mp3"></audio>
  <audio id="audio_mimimi"                    src="/audio/WoWQuote/mimimi.mp3"></audio>
  <audio id="audio_mundstuhl"                 src="/audio/WoWQuote/mundstuhl.mp3"></audio>
  <audio id="audio_blamage"                   src="/audio/WoWQuote/blamage.mp3"></audio>
  <audio id="audio_scheisse"                  src="/audio/WoWQuote/scheisse.mp3"></audio>
  <audio id="audio_schwarzerbildschirm"       src="/audio/WoWQuote/schwarzerbildschirm.mp3"></audio>
  <audio id="audio_wernerflasche"             src="/audio/WoWQuote/wernerflasche.wav"></audio>
  <audio id="audio_cundflicht"                src="/audio/WoWQuote/cundflicht.mp3"></audio>
  
  
  <!-- Shrine Background -->
  <audio id="audio_shrine"          src="/audio/ds3_firelinkshrine.mp3"></audio>
  
  <!--
  <audio id="audio_shrine"          src="/audio/DancingWithTearsInMyEyes.mp3"></audio>
  <audio id="audio_shrine"          src="/audio/DarkSoulsBonfireSoundEffect(cropped).ogg"></audio>
  <audio id="audio_shrine"          src="/audio/DarkSoulsBonfireSoundEffect(cropped)LowerVolume.ogg"></audio>
  <audio id="audio_shrine"          src="/audio/DS1_Firelink_Shrine.mp3"></audio>
  -->
</div>

  

<!-- LATEST ROLLS MODAL POPUP -->
<!-- <button id="myBtn" class="button">latestRolls()</button> -->
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

<?php
// Session/Login end
/*
} else { 
  include("login.inc.php");
}
*/
?>