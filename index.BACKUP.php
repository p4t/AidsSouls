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

// include_once("superaids.inc.php");

// check for rndwpn
if ( !empty($_GET["mode"]) && $_GET["mode"] == "rndwpn" ) die(randomWeapon());

/*
$mobs_data = $pdo->query("SELECT * from mobs")->fetchAll(PDO::FETCH_GROUP);
$boss_data = $pdo->query("SELECT * from boss")->fetchAll(PDO::FETCH_GROUP);
var_export($mobs_data);
*/
  
/*
foreach ($mobs_data as $field => $val) {
  echo htmlspecialchars("Field: $field VAL:  $val");
  echo "<br>";
}
*/


/* SQL
SELECT
(SELECT COUNT(dice) FROM mobs) as mobsCount,
(SELECT COUNT(dice) FROM boss) as bossCount,
(SELECT name FROM mobs WHERE dice = 1) as mobsAids,
(SELECT name FROM boss WHERE dice = 5) as bossAids;

SELECT (SELECT COUNT(dice) FROM mobs) as mobsCount, (SELECT COUNT(dice) FROM boss) as bossCount;

SELECT mobs.name, boss.name FROM mobs, boss WHERE mobs.dice = $mobsRNG AND boss.dice = $bossRNG;


SELECT
(SELECT COUNT(dice) FROM mobs) as mobsCount,
(SELECT name FROM mobs WHERE dice = FLOOR(RAND() * (20 - 1 + 1))) as mobsAids,
(SELECT COUNT(dice) FROM boss) as bossCount,
(SELECT name FROM boss WHERE dice = FLOOR(RAND() * (12 - 1 + 1))) as bossAids
*/


// Get max dice value for mt_rand()
$stmt = $pdo->prepare( "SELECT (SELECT COUNT(dice) FROM mobs) as mobsCount, (SELECT COUNT(dice) FROM boss) as bossCount" );
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);


// MOBS, BOSS RNG
$mobsRNG  = mt_rand (1, $row["mobsCount"]);
$bossRNG  = mt_rand (1, $row["bossCount"]);

/* DEBUG */
/*
$mobsRNG    = 20;
$bossRNG    = 5;
*/

// Get Aids name from mobs boss tables 
$stmt = $pdo->prepare("SELECT mobs.name, boss.name FROM mobs, boss WHERE mobs.dice = $mobsRNG AND boss.dice = $bossRNG");
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_GROUP);

$mobsAids   = $row[0];
$bossAids   = $row[1];

$weaponIMG  = "&nbsp;<img src=\"/img/weapon_icon.png\" width=\"41\" height=\"40\" alt=\"Weapon\">";

// Append weapon img HACK
if ( $mobsAids == "Zufällige Waffe" ) {
  $mobsAids = randomWeapon();
  $mobsAidsOutput = $mobsAids . $weaponIMG;
} else {
  $mobsAidsOutput = $mobsAids;
}

if ( $bossAids == "Zufällige Waffe" ) {
  $bossAids = randomWeapon();
  $bossAidsOutput = $weaponIMG . $bossAids;
} else {
  $bossAidsOutput = $bossAids;
}

// Write aids rolls into DB  
$date = date("Y-m-d H:i:s");
$IP   = getIpAddr();
$sql  = "INSERT INTO rolls (date, IP, mobs, boss) VALUES (:date, :IP, :mobs, :boss)";
$stmt = $pdo->prepare($sql);                                  
$stmt->bindParam(":date", $date, PDO::PARAM_STR);
$stmt->bindParam(":IP", $IP, PDO::PARAM_STR);
$stmt->bindParam(":mobs", $mobsAids, PDO::PARAM_STR);
$stmt->bindParam(":boss", $bossAids, PDO::PARAM_STR);
$stmt->execute();
// Table/Output in edit.php
?>

<!doctype html>
<html lang="de">
<head>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  
<title>\[T]/</title>
<base href="http://aids.gyros-mit-zaziki.de">

<link rel="stylesheet" href="/css/layout.css" type="text/css" media="screen">
<link rel="stylesheet" href="/css/flex.css" type="text/css" media="screen">
<link rel="stylesheet" href="/css/button.css" type="text/css" media="screen">
<link rel="stylesheet" href="/css/table.css" type="text/css" media="screen">
<link rel="stylesheet" href="/css/form.css" type="text/css" media="screen">
<link rel="stylesheet" href="/css/datatip.css" type="text/css" media="screen">
<link rel="stylesheet" href="/css/mobile.css" type="text/css" media="screen">
  
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/balloon-css/0.5.0/balloon.min.css">

<link rel="apple-touch-icon" sizes="180x180" href="/img/favico/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="/img/favico/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/img/favico/favicon-16x16.png">
<link rel="manifest" href="/manifest.json">
<link rel="mask-icon" href="/img/favico/safari-pinned-tab.svg" color="#3f292b">

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
  
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Prevent new line break on enter key-->
<script>
$("#flex-container-ajax").on("keydown", function(e) {
  if (e.which == 13 && e.shiftKey == false) {
    // Prevent insertion of a return
    // You could do other things here, for example
    // focus on the next field
    // alert("NLB");
    return false;
  }
});  
</script>

<!-- jQuery Ajax inline edit -->
<script>  
$(function(){
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
          /*
          if (data != "") {
            message_status.show();
            message_status.text(data);
            // hide the message
            setTimeout(function(){message_status.hide()},3000); // 3000
			   }
          */
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
    var vmobs     = $("input#ajax_mobs").val(); // mobs input field
    var vboss     = $("input#ajax_boss").val(); // boss field
    var vweapons  = $("input#ajax_weapons").val(); // weapons field
  
    if ($.trim(vmobs) == "" && $.trim(vboss) == "" && $.trim(vweapons) == "") {
      alert("Mindestens 1 Feld ausfüllen");
      // $("#success").text("Bitte ausfüllen!" + "<br>");
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
          $("#form")[0].reset();
          $("#flex-container-ajax").load("aids.ajax.php"); // load weapons list again for ajax bamboozle
        });
    } // ENDIF
    
  });
});
</script>
  
<!-- Toggles -->
<script>
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
  
  
</script>
  
<!-- W12 -->
<script>
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
</script>

<!-- Rerun -->
<script>  
  /*
  * roll dice 1-100, success if dice is either 77 or 7
  * 1 = 
  *
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

        if ( $("#rerunroll").css("display") === "block" ) { 
          play_audio("superaids");
          $("#bonfire").hide();
          $("#rerunroll").load("superaids.inc.php"); // Ajax load superaids php
        }

      }
      
    } // ENDIF
    
    /* always uncheck checkbox "rerun_only" on every click if bonfire is hidden */
    if ( $("input#rerun_only").is(":checked") && $("#bonfire").css("display") == "block" ) {
      $("input#rerun_only").prop("checked", false);
    }
    
  } // EOF RERUN()
</script> 
 
<!-- Reload Page -->
<script>  
function reload_page () {
  location.reload();
}
  
function reroll () {
  play_audio("aids");
  
  setTimeout(function() { reload_page(); }, 1800); // time to play rich evans aids
  
}
</script>  

<!-- Play Audio -->
<script>
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
  
</head>

<body spellcheck="false">
  

<!-- <div id="fullscreen"> -->
  <!--
  <iframe id="ytplayer" type="text/html" width="640" height="390"
  src="https://www.youtube.com/watch?v=gy1B3agGNxw?autoplay=1&origin=http://aids.gyros-mit-zaziki.de/"
  frameborder="1"/>
  -->
<!-- </div> -->
  
<!-- Wrapper -->
<div class="container">

<header>
  <!-- <img src="/img/ds1_logo.png" alt="Dark Souls II Logo" width="630" height="80"> -->
  <!-- <img src="/img/ds2_logo.png" alt="Dark Souls II Logo" width="630" height="80"> -->
  <img src="/img/ds3_logo.png" alt="Dark Souls III Logo" width="661" height="80">
  <!-- <img src="/img/ds1remaster_logo.png" alt="Dark Souls II Logo" width="630" height="80"> -->
  <h4>mit verschärftem AIDS</h4>  
</header>

<a id="Roll"></a>

<div class="content">
<div class="aidscontent">
  
<!-- AIDS: MOBS, MIDDLE, BOSS -->
<div id="flex-container-aids">

  <!-- MOBS left -->
  <div class="flex-item-aids-left">
    <h2>Mobs</h2>
    <img src="dice/<?=$mobsRNG?>.png" class="dice" width="100" height="100" alt="<?=$mobsRNG?>">
  </div>
  
  <!-- MIDDLE -->
  <!-- bonfire -->
  <div id="bonfire" class="flex-item-aids-middle" data-balloon="Firelink Shrine abspielen" data-balloon-pos="up">
    <span class="bonfire">
      <img src="/img/WeirdTepidChital-max-1mb.gif" width="172" height="236" alt="" onClick="play_audio('shrine')">
    </span>
  </div>
  
  <!-- w12 output -->
  <div id="w12" class="flex-item-aids-middle" style="display: none;">
    <h2>W12</h2>
    <img src="/dice/0.png" class="dice" id="randimgw12" width="100" height="100" alt="Dice 0">
  </div>
  
  <!-- rerunroll -->
  <div class="flex-item-aids-middle" id="rerunroll" style="display: none;"></div>

  <!-- BOSS right -->
  <div class="flex-item-aids-right">
    <h2>Boss</h2>
    <img src="/dice/<?=$bossRNG?>.png" class="dice" width="100" height="100" alt="<?=$bossRNG?>">
  </div>
  
</div><!-- EOF flex-container-aids -->

  
<!-- OUTPUT ROLLED AIDS -->
<div id="flex-container-aids-text">
  <div>
    <span class="aidsText">
      <?=$mobsAidsOutput?>
    </span>
  </div>

  <div>
    <span class="aidsText">
      <?=$bossAidsOutput?>
    </span>
  </div>
</div><!-- EOF flex-container-aids -->
  
  
<!-- BUTTONS -->
<div id="flex-container-roll">
  
  <!-- Reroll / Reload page -->
  <div class="flex-item">
    <button id="reroll_hover" class="button" onClick="reroll()" data-balloon="<?=getLatestRoll()?>" data-balloon-pos="down">
      <span>Reroll</span>
    </button>
  </div>
  
  <!-- W12 -->
  <div class="flex-item">
    <button class="button" onClick="pickimg()">
      <span>W12</span>
    </button>
  </div>
  
  
  <!-- Rerun? -->
  <div class="flex-item">
    <label for="rerun_only" class="rerun_checkbox">
      <input type="checkbox" id="rerun_only" data-balloon="Nur Rerun (Kein Vader, Superaids)" data-balloon-pos="down">
    </label>
    <button class="button" onClick="rerun()">
      <span>Rerun</span>
    </button>
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

  <!-- Ajax Success Msg -->
  <div id="status"></div>
  
  <!-- jQuery Form: Add Mobs, Boss, Weapons -->
  <form id="form" method="post" onsubmit="return false">
    <div id="flex-container-ajax-form">
      <!-- Mobs -->
      <div class="flex-item-ajax-form">
        <label for="ajax_mobs" class="">
          <em><strong>Mobs:</strong></em>
          <input type="text" id="ajax_mobs" value="" size="10" autocomplete="off" maxlength="32" placeholder="...">
        </label>
      </div>
      <!-- Boss -->
      <div class="flex-item-ajax-form">
        <label for="ajax_boss">
          <em><strong>Boss:</strong></em>
          <input type="text" id="ajax_boss" value="" size="10" autocomplete="off" maxlength="32" placeholder="...">
        </label>
      </div>
      <!-- Weapons -->
      <div class="flex-item-ajax-form">
        <label for="ajax_weapons">
          <em><strong>Waffe:</strong></em>
          <input type="text" id="ajax_weapons" value="" size="10" autocomplete="off" maxlength="32" placeholder="...">
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
  <tr> 
    <td class="emoji">
      <a href="edit.php?mode=kills&ID=<?=$row["ID"]?>" target="_blank" onClick="play_audio('<?=$row["name"]?>')" data-balloon="<?=$row["name"]?>" data-balloon-pos="up"><?=replaceNameWithEmoji( $row["name"] )?></a>
    </td>

    <td>
      <a href="edit.php?mode=kills&ID=<?=$row["ID"]?>" target="_blank" onClick="play_audio('<?=$row["name"]?>')" data-balloon="<?=$row["joker"]?> gekillte Bosse" data-balloon-pos="up"><?=numberToTally( $row["joker"] )?></a>
    </td>

    <td>
      <a href="edit.php?mode=kills&ID=<?=$row["ID"]?>" target="_blank" onClick="play_audio('<?=$row["name"]?>')" data-balloon="<?=$joker?> Joker übrig" data-balloon-pos="up"><?=replaceIntWithFlasks( $joker )?></a>
    </td>

    <td id="id:<?=$row["ID"]?>" contenteditable="true" onClick="play_audio('<?=$row["name"]?>')">
      <a href="edit.php?mode=kills&ID=<?=$row["ID"]?>" target="_blank" onClick="play_audio('<?=$row["name"]?>')" data-balloon="<?=replaceBrWithComma( $row["bossNames"] )?>" data-balloon-pos="up"><?=replaceCheeseWithEmoji( nl2br($row["bossNames"]) )?></a>
    </td>
  </tr>
<?php
ENDWHILE
?>
 
    </tbody>
  </table>
</div><!-- EOF killedBosses -->
  

<!-- FOOTER -->
<hr>
<footer>
  <nav>
    <a href="#">^</a> |
    <a href="#Roll">Roll</a> |
    <a href="#Aids">Aids</a> |
    <a href="#Kills">Kills</a> |
    <a href="/edit" target="_blank">Edit</a>
  </nav>
</footer>
<hr>
  

</div><!-- EOF Content -->
</div><!-- EOF Container -->
  
  
<!-- AUDIO -->
<div id="audio">
  <audio id="audio_Biber"     src="/audio/biber.mp3"></audio>
  <audio id="audio_Katz"      src="/audio/meow.mp3"></audio>
  <audio id="audio_Pat"       src="/audio/Pat.mp3"></audio>
  <audio id="audio_haha"      src="/audio/SadTrombone.mp3"></audio>
  <audio id="audio_yes"       src="/audio/EpicSaxGuy.mp3"></audio>
  <audio id="audio_no"        src="/audio/nooo.ogg"></audio>
  <audio id="audio_dice"      src="/audio/dice.wav"></audio>
  <audio id="audio_shrine"    src="/audio/ds3_firelinkshrine.mp3"></audio>
  <audio id="audio_aids"      src="/audio/aids.mp3"></audio>
  <audio id="audio_superaids" src="/audio/superaids.mp3"></audio>
</div>

</body>
</html>