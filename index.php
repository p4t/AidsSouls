<?php
// Lib
require_once("config.db.php");
require_once("functions.inc.php");
require_once("globals.inc.php");

// Logout
if (
    (!empty($_GET["action"])) &&
    ($_GET["action"] == "logout") &&
    ($_SESSION["valid"] == true)
   ) {
  logout();
}


// Change Game
if (
  
  ( !empty($_GET["mode"]) && $_GET["mode"] == "selectGame" )
  &&
  // ( !empty($_POST["selectGame"]) )
  ( !empty($_GET["game"]) )
  
   ) {
  // $selectGame = $_POST["selectGame"];
  $selectGame = $_GET["game"];
  
  changeGame($selectGame);
  redirect("/");
}



// DB Hack
// include_once("aids.ajax.php");
// include_once("jquery_post.php");
// include_once("edit.ajax.php");
// include_once("todo.ajax.php");
// include_once("autocomplete.jQuery.php");

// include_once("/css/login.css");


// Get random number
$RNG        = getRNG();
$mobsRNG    = $RNG[0];
$bossRNG    = $RNG[1];

// Get random number for NG+
$RNGNGP        = getRNG();
$mobsRNGNGP    = $RNGNGP[0];
$bossRNGNGP    = $RNGNGP[1];

$flasks     = _FLASKS;
$weaponIMG  = "<img src=\"/img/weapon_icon.png\" width=\"30\" height=\"30\" alt=\"Weapon\">"; // 41, 40

// DEBUG
// $mobsRNG = 15;
// $bossRNG = 5;

if ( !empty($_GET["RNG"]) ) {
  $mobsRNG = $_GET["RNG"];
  $bossRNG = $_GET["RNG"];
}
if ( !empty($_GET["mobsRNG"]) ) {
  $mobsRNG = $_GET["mobsRNG"];  
}
if ( !empty($_GET["bossRNG"]) ) {
  $bossRNG = $_GET["bossRNG"];
}


// Get Aids from mobs boss tables 
$Aids     = getAidsByRNG($mobsRNG, $bossRNG);
$mobsAids = $Aids[0];
$bossAids = $Aids[1];

// Get aids from mobs boss tables for NG+
$AidsNGP     = getAidsByRNG($mobsRNGNGP, $bossRNGNGP);
$mobsAidsNGP = $AidsNGP[0];
$bossAidsNGP = $AidsNGP[1];

// Output for dice-wrapper display
$mobsRNG_Output = replaceDiceWithSymbol ($mobsAids, $mobsRNG);
$bossRNG_Output = replaceDiceWithSymbol ($bossAids, $bossRNG);

// Random Weapon
// $randomWeapon = randomWeapon();

// Get Todo List from DB
if ( _SHOWTODO !== FALSE ) {
  $stmt = $pdo->prepare( "SELECT * FROM {$GAME}_todo" );
  $stmt->execute();
  $row = $stmt->fetch(PDO::FETCH_ASSOC);

  $todoID   = $row["ID"];
  $todoText = $row["todoText"];
}

// Debug
// $debug = debug($mobsRNG, $mobsAids, $bossRNG, $bossAids, $randomWeapon);

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
<link rel="stylesheet" href="/css/messages.css" type="text/css" media="screen">
<link rel="stylesheet" href="/css/dice_animations.css" type="text/css" media="screen">
<link rel="stylesheet" href="/css/mobile.css" type="text/css" media="screen">

<!-- jQuery UI CSS -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<!-- Font Awesome -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.12/css/all.css" integrity="sha384-G0fIWCsCzJIMAVNQPfjH08cyYaUtMwjJwqiRKxxE/rx96Uroj1BtIQ6MLJuheaO9" crossorigin="anonymous">

<!-- Balloon Tooltip -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/balloon-css/0.5.0/balloon.min.css">

<!-- Background Image per _GAME -->
<style>
  html {
    background: url("/img/bg/<?=$GAME?>.jpg") no-repeat center center fixed;
    background-color: black;

    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
  }
</style>


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
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

</head>


<body spellcheck="false">


<?php
  /* DEBUG OUTPUT */
  if ( !empty($debug) ) echo $debug;
?>
  

<!-- Wrapper -->
<div class="container">

<!-- Header -->
<header>
  <a href="/">
    <img src="/img/<?=_GAME?>_logo.png" alt="Dark Souls Logo"> <!--  width="661" height="80" -->
  </a>
  <h4>mit verschärftem AIDS</h4>  
</header>

<!-- Nav: Select Game -->
<nav>
  <select id="selectGame" name="selectGame">
    <option value="1" <?=(_GAME == "des")   ? "selected"  :""?> disabled>Demon's Souls</option>
    
    <option value="2" <?=(_GAME == "ds1")   ? "selected"  :""?>>Dark Souls I</option>
    <option value="3" <?=(_GAME == "ds2")   ? "selected"  :""?>>Dark Souls II</option>
    <option value="4" <?=(_GAME == "ds3")   ? "selected"  :""?>>Dark Souls III</option>
    <option value="5" <?=(_GAME == "ds1r")  ? "selected"  :""?>>Dark Souls Remastered</option>
    <option value="6" <?=(_GAME == "bb")    ? "selected"  :""?>>Bloodborne</option>
  </select>
</nav>


<!-- Check for missing Dice -->
<?php
  // Check Missing Dice
  checkMissingDice();
?>


<div class="content">
<div class="aidscontent">
  
<!-- !!!AIDS: MOBS, MIDDLE, BOSS -->
<div id="flex-container-aids">

  <!-- MOBS left -->
  <div class="flex-item-aids-left">
    <h2>Mobs</h2>
    <div class="bounceInDownRotate">
      <div class="dice_wrapper" onClick="showRNG()">
        <div id="mobsRNGNumber" class="diceText" style="display: none"><?=$mobsRNG?></div>
        <div id="mobsRNG"><?=$mobsRNG_Output?></div>
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
  <div id="w12" class="flex-item-aids-middle" style="display: none;">
    <h2 id="dice_h2" onClick="openBonfire()">W12</h2>
    <div id="diceOnClickAnimate" class="flip-scale-up-diag-1 user-select" onclick="pickimg()">
      <!-- <img src="/img/stats/ds1/att.jpg" width="45" height="45" alt=""/> -->
      <div id="randomDiceOut">
        &nbsp;
      </div>
      <!-- <img src="/dice/0.png" class="dice flip-scale-up-diag-1" id="randimgw12" width="100" height="100" alt="Dice"> -->
      <!-- <div id="randimgw12" style="height: 100px"></div> -->
    </div>
  </div>
  
  <!-- rerunroll -->
  <div class="flex-item-aids-middle" id="rerunroll" style="display: none;"></div>

  <!-- BOSS right -->
  <div class="flex-item-aids-right">
    <h2>Boss</h2>
    <div class="bounceInDownRotate">
      <div class="dice_wrapper" onClick="showRNG()">
        <div id="bossRNGNumber" class="diceText" style="display: none"><?=$bossRNG?></div>
        <div id="bossRNG"><?=$bossRNG_Output?></div>
      </div>
    </div>
  </div>
  
</div><!-- EOF flex-container-aids -->

  
<!-- !!!OUTPUT ROLLED AIDS -->
<div id="flex-container-aids-text">
  <div>
    <div class="aidsText tracking-in-expand">
      <span id="mobsAids" data-balloon="{Description}" data-balloon-pos="right"><?=$mobsAids?></span>
      <br>
      <?php
        if ( _NEWGAMEPLUS === TRUE ) {
      ?>
      <span id="mobsAidsNGP" data-balloon="{Description}" data-balloon-pos="right"><?=$mobsAidsNGP?></span>
      <?php
        }
      ?>
    </div>
  </div>

  <div>
    <div class="aidsText tracking-in-expand">
      <span id="bossAids" data-balloon="{Description}" data-balloon-pos="left"><?=$bossAids?></span>
      <br>
      <?php
        if ( _NEWGAMEPLUS === TRUE ) {
      ?>
      <span id="bossAidsNGP" data-balloon="{Description}" data-balloon-pos="left"><?=$bossAidsNGP?></span>
      <?php
        }
      ?>
    </div>
  </div>
</div><!-- EOF flex-container-aids -->

  
<!-- !!!BUTTONS -->
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
      <option value="W1">Stats</option>
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
    
    // W12 etc
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
  
  
<hr>

  
<h5 id="Aids">Aids</h5>
<!-- !!!LIST OF ALL THE AIDS: MOBS BOSS, WEAPONS --> 
<form id="form" method="post" onsubmit="return false">

<div class="aidsListing">
  <div id="flex-container-ajax">
    <?php
    // include_once("aids.ajax.php");

    // $tables = array("mobs", "boss", "weapons");
    $tables = array("mobs", "boss", "weapons");

    foreach ($tables as $table) :
      $mode = $table;
      $table = _GAME . "_" . $table;

      $table_output = ucfirst($mode);
      if ( $table_output == "Weapons" ) $table_output = "Waffen";
      $stmt = $pdo->prepare("SELECT * FROM $table ORDER BY dice");
      $stmt->execute();
    ?>

        <div class="flex-item-aidsListing">
          <h3><?=$table_output?></h3>
          <ul id="<?=$table?>" class="aidsList">
            <?php while ($row = $stmt->fetch(PDO::FETCH_NUM)) : ?>

            <!-- DELETE -->
            <!--
            <a data-value="<?php//$row[0]?>" class="aidsListAjaxDel" data-table="<?php//$table?>" data-balloon="Löschen" data-balloon-pos="right">
              <img src="/img/delete-icon.png" width="20" height="20" alt="Delete">
            </a>
            -->

            <!-- List Item -->
            <li id="table:<?=$table?>:id:<?=$row[0]?>" data-autocomplete="<?=$mode?>" contenteditable="true">
              <?=$row[2]?>
            </li>
            <?php ENDWHILE ?>
          </ul>

          <label for="ajax_<?=$mode?>">
            <span data-balloon="<?=$table_output?>-Aids hinzufügen" data-balloon-pos="down">
              +
            </span>
            &nbsp;
            <input type="text" id="ajax_<?=$mode?>" name="ajax_<?=$mode?>" data-jQAutocomplete="<?=$mode?>" size="15" autocomplete="off" maxlength="32" placeholder="<?=ucfirst($table_output)?>">
          </label>

        </div><!-- EOF .flex-item-aidsListing -->

    <?php
      ENDFOREACH
    ?>





  </div><!-- .flex-container-ajax -->

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
$stmt = $pdo->prepare("SELECT * FROM {$GAME}_kills");
$stmt->execute();
      
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) :
  $joker = $row["joker"] - $row["spent"];
?>
  <tr id="id:<?=$row["ID"]?>:name:<?=$row["name"]?>" onClick="play_audio('<?=$row["name"]?>')"><!-- contenteditable="true" -->
    <td class="emoji">
      <a href="edit?mode=kills&ID=<?=$row["ID"]?>" target="_blank" data-balloon="<?=$row["name"]?>" data-balloon-pos="up"><?=replaceNameWithEmoji( $row["name"] )?></a>
    </td>

    <td>
      <a href="edit?mode=kills&ID=<?=$row["ID"]?>" target="_blank" data-balloon="<?=$row["joker"]?> Bosse besiegt" data-balloon-pos="up"><?=numberToTally( $row["joker"] )?></a>
    </td>

    <td>
      <a href="edit?mode=kills&ID=<?=$row["ID"]?>" target="_blank" data-balloon="<?=$joker?> Joker übrig" data-balloon-pos="up"><?=replaceIntWithFlasks( $joker )?></a>
    </td>

    <td>
      <a href="edit?mode=kills&ID=<?=$row["ID"]?>" target="_blank" data-balloon="<?=replaceBrWithComma( $row["bossNames"] )?>" data-balloon-pos="up" data-balloon-length="xlarge">
        <?php // replaceCheeseWithEmoji( nl2br($row["bossNames"]) )?>
        <ul class="killsList">
          <li>
            <?=replaceCheeseWithEmoji( replaceLineBreakWithList($row["bossNames"]) )?>
            <?php // wordwrap()??? ?>
          </li>
        </ul>
      </a>
    </td>
  </tr>
<?php
ENDWHILE
?>
 
    </tbody>
  </table>
</div><!-- EOF killedBosses -->


<!-- Todo -->
<?php
if (_SHOWTODO == TRUE) {
?>
<hr>  
  
<h5 id="Todo">Todo</h5>
<div id="todo" contenteditable="true" data-balloon="2x Enter für Zeilenumbruch" data-balloon-pos="up">
  <?=$todoText?>
</div>
<?php
}
?>

  
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
  
  
  <!-- Presi -->
  <audio id="audio_presi1"  src="/audio/random/presi1.mp3"></audio>
  <audio id="audio_presi2"  src="/audio/random/presi2.mp3"></audio>
  <audio id="audio_presi3"  src="/audio/random/presi3.mp3"></audio>
  <audio id="audio_presi4"  src="/audio/random/presi4.mp3"></audio>
  <audio id="audio_presi5"  src="/audio/random/presi5.mp3"></audio>
  <audio id="audio_presi6"  src="/audio/random/presi6.mp3"></audio>
  <audio id="audio_presi7"  src="/audio/random/presi7.mp3"></audio>
  
  
  <!-- Werner -->
  <audio id="audio_werner1"     src="/audio/werner/Wo.mp3"></audio>
  <audio id="audio_werner2"     src="/audio/werner/Wieso.mp3"></audio>
  <audio id="audio_werner3"     src="/audio/werner/WelchenSchluessel.mp3"></audio>
  <audio id="audio_werner4"     src="/audio/werner/Waslos.mp3"></audio>
  <audio id="audio_werner5"     src="/audio/werner/Verscheidenes.mp3"></audio>
  <audio id="audio_werner6"     src="/audio/werner/SchoenWaschiWaschimachen.mp3"></audio>
  <audio id="audio_werner7"     src="/audio/werner/Ruelps.mp3"></audio>
  <audio id="audio_werner8"     src="/audio/werner/RoehrichFurz.mp3"></audio>
  <audio id="audio_werner9"     src="/audio/werner/Matratzeee.mp3"></audio>
  <audio id="audio_werner10"    src="/audio/werner/Kaaaaaaaanzler.mp3"></audio>
  <audio id="audio_werner11"    src="/audio/werner/Kissen.mp3"></audio>
  <audio id="audio_werner12"    src="/audio/werner/AlleseinDurcheinander.mp3"></audio>
  <audio id="audio_werner13"    src="/audio/werner/Bettenmachen.mp3"></audio>
  <audio id="audio_werner14"    src="/audio/werner/Jaaaahaaaaaaaaa.mp3"></audio>
  <audio id="audio_werner15"    src="/audio/werner/IchbrauchdenSchluessel.mp3"></audio>
  <audio id="audio_werner16"    src="/audio/werner/HerrBiernot.mp3"></audio>
  <audio id="audio_werner17"    src="/audio/werner/FuernHeizungskeller.mp3"></audio>
  <audio id="audio_werner18"    src="/audio/werner/Ellllllfriiiiiiiede.mp3"></audio>
  <audio id="audio_werner19"    src="/audio/werner/Elfriiiiiiede.mp3"></audio>
  <audio id="audio_werner20"    src="/audio/werner/Eieieiwoisserdenn.mp3"></audio>
  <audio id="audio_werner21"    src="/audio/werner/Eckaaaaaat.mp3"></audio>
  <audio id="audio_werner22"    src="/audio/werner/Decke.mp3"></audio>
  <audio id="audio_werner23"    src="/audio/werner/DaobenbeiFrauHansen.mp3"></audio>
  <audio id="audio_werner24"    src="/audio/werner/JedenMorgendasselbeTheater.mp3"></audio>
  <audio id="audio_werner25"    src="/audio/werner/Rohrbruch.mp3"></audio>
  <audio id="audio_werner26"    src="/audio/werner/Krankenhaus.mp3"></audio>
  <audio id="audio_werner27"    src="/audio/werner/Furz.mp3"></audio>
  
  
  <!-- Random -->
  <audio id="audio_flanders"                src="/audio/random/flanders.mp3"></audio>
  <audio id="audio_frieza"                  src="/audio/random/frieza.mp3"></audio>
  <audio id="audio_joker"                   src="/audio/random/Joker_Laughing.mp3"></audio>
  <audio id="audio_rlmwhistle"              src="/audio/random/rlmwhistle.mp3"></audio>
  
  
  <!-- Shrine Background -->
  <audio id="audio_shrine"          src="/audio/DS1_Firelink_Shrine.mp3"></audio>
  
  <!--
  <audio id="audio_shrine"          src="/audio/ds3_firelinkshrine.mp3"></audio>
  <audio id="audio_shrine"          src="/audio/DancingWithTearsInMyEyes.mp3"></audio>
  <audio id="audio_shrine"          src="/audio/DarkSoulsBonfireSoundEffect(cropped).ogg"></audio>
  <audio id="audio_shrine"          src="/audio/DarkSoulsBonfireSoundEffect(cropped)LowerVolume.ogg"></audio>
  <audio id="audio_shrine"          src="/audio/DS1_Firelink_Shrine.mp3"></audio>
  -->
</div>



<!-- LATEST ROLLS MODAL POPUP -->
<div id="myModal" class="modal animate">
  <div class="modal-content">
    <span class="close" style="display: none;"><!-- &times; --></span>
    <div class="message">
      <div class="message_line">
        <?php
        $data = $pdo->query("SELECT date, IP, mobs, boss FROM {$GAME}_rolls WHERE mobs != '' AND boss != '' ORDER BY ID DESC LIMIT 1, 4")->fetchAll(PDO::FETCH_ASSOC);
        foreach ($data as $value) :
        ?>
        <div class="row">
          <div class="col"><?=$value["mobs"]?></div>
          <div class="col"><?=$value["boss"]?></div>
          <!-- <div class="col"><?php//formatDate($value["date"])?></div> -->
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



<!-- Json Test -->
<!--
<button onClick="json_test()">json</button>
<div id="json"></div>
-->

<!-- jQuery Autocomplete -->
<script>
$( function() {

  var availableTagsWeapons  = <?php include("autocomplete.jQuery.php");?>;
  var availableTagsMobsBoss = <?php include("autocomplete/aids.php");?>;
  
  $( "input[data-jQAutocomplete=mobs], input[data-jQAutocomplete=boss]" ).autocomplete({
    minLength: 0,
    source: availableTagsMobsBoss
  });
  
  $( "input[data-jQAutocomplete=weapons]" ).autocomplete({
    minLength: 0,
    source: availableTagsWeapons
  });
  
  // $.fn.val = $.fn.html; // <li> Hack
  $( "li[data-autocomplete=weapons]" ).autocomplete({
    minLength: 0,
    source: availableTagsWeapons
  });
  $( "li[data-autocomplete=mobs], li[data-autocomplete=boss]" ).autocomplete({
    minLength: 0,
    source: availableTagsMobsBoss
  });

} );
</script>

<!-- localStorage -->
<script>
/*
$( document ).ready(function() {

  if (typeof(Storage) !== "undefined") {
    // Code for localStorage/sessionStorage.
    // alert ("localStorage.true");
    
    // $("#status").show();
    // $("#status").text("localStorage.true");

    // Store
    localStorage.setItem("test", "localStorage.Schnagges");
    // Retrieve
    // document.getElementById("status").innerHTML = localStorage.getItem("test");
    // alert (localStorage.getItem("test"));
    $("#status").show();
    $("#status").text(localStorage.getItem("test"));
    
  } else {
    // Sorry! No Web Storage support..
  }
  
});
*/
</script>
  
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
    
    var vmobs     = document.getElementById("ajax_mobs").value;
    var vboss     = document.getElementById("ajax_boss").value;
    var vweapons  = document.getElementById("ajax_weapons").value;
    /*
    var vmobs     = $("input#ajax_mobs").val(); // mobs input field
    var vboss     = $("input#ajax_boss").val(); // boss field
    var vweapons  = $("input#ajax_weapons").val(); // weapons field
    */

    /*
    console.log(vmobs);
    console.log(vboss);
    console.log(vweapons);
    */
  

    
    if ($.trim(vmobs) == "" && $.trim(vboss) == "" && $.trim(vweapons) == "") {
      //alert("Mindestens 1 Feld ausfüllen!");
      
      // $("#status").replaceWith( "Mindestens 1 Feld ausfüllen!" );
      // $("#success").text("Bitte ausfüllen!" + "<br>");
      message_status.show();
      message_status.text("Mindestens 1 Feld ausfüllen!");
      // hide the message
      setTimeout(function(){message_status.hide()},3000); // 3000
      
      // discombobulate();
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
            // message_status.text("Hinzugefügt.");
            message_status.text(response);
            // hide the message
            setTimeout(function(){message_status.hide()},30000); // 3000
         }
        
        
          $("#form")[0].reset();
          // $("#flex-container-ajax").load("aids.ajax.php"); // load weapons list again for ajax bamboozle
         
        // console.log("response: "+response);
        // console.log("status: "+status);
        // console.log("mobs: "+mobs);
        // if (vmobs != "") console.log("debug: "+vmobs);
        
        var post_data;
        if ( vmobs != "" ) post_data = vmobs;
        else if (vboss != "" ) post_data = vboss;
        else if ( vweapons != "" ) post_data = vweapons;
        
        $("#"+response).append("<li>" +post_data+ "</li>");
        
        
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

<!-- Get Game Json -->
<script>
// Get active _GAME
/*
$( document ).ready(function() {
  var _GAME = include("getGame.json.php"); ;
  console.log("_GAME: " + _GAME);
});
*/
</script>

<!-- W6, W12, W20, W30 -->
<script>

var _GAME = '<?=_GAME;?>';

// Random image out of 12
var dice = [
  "1","2","3","4","5","6","7","8","9","10",
  "11","12","13","14","15","16","17","18","19","20",
  "21","22","23","24","25","26","27","28","29","30"
];

/*
var stats = [
  "VIT", "ATT", "END", "STR", "DEX", "RES", "INT", "FTH", "FFA", "FFA", "FFA", "FFA"
];
*/

// Get stats depending on active _GAME
var stats = <?php include("stats.inc.php");?>;

function getRandomInt(min, max) {
  if ( $("#dice_dropdown option:selected").text() == "W6" ) max = 6;
  return Math.floor(Math.random() * (max - min + 1)) + min;
}

function pickimg(w = 0) {
  
  if ( $("#w12").css("display") == "none" ) {

    $("#w12").show();
    $("#bonfire").hide();

    // close div of rerun() if shown
    $("#rerunroll").hide();
    // stop audio of rerun
    stop_audio();
    // play audio
    play_audio("dice");

  } else {
    // Disable hiding w12, showing bonfire when clicking on dice
    // and add in jQuery animation for dice on click
    play_audio("dice");
    $("#randomDiceOut").addClass( "flip-scale-up-diag-1" ).one("webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend", function(){
        $(this).removeClass( "flip-scale-up-diag-1" );
    });
    
  }

 

/* Select */
  // W6
  if ( $("#dice_dropdown").val() == "W1" ) { // if ( $("#dice_dropdown option:selected").text() == "W6" ) {
  diceRND = stats;
  $("#dice_h2").text("Stats");
  
  // set var to let function no a Stat was rolled
  var stat_css = true;
  
} else if ( $("#dice_dropdown").val() == "W6" ) {
  diceRND = dice.slice(0, 6);
  $("#dice_h2").html("W6");
  
  // W12
} else if ( $("#dice_dropdown").val() == "W12" ) {
  diceRND = dice.slice(0, 12);
  $("#dice_h2").text("W12");
  
  // W20
} else if ( $("#dice_dropdown").val() == "W20" ) {
  diceRND = dice.slice(0, 20);
  $("#dice_h2").text("W20");
  
  // W30
} else if ( $("#dice_dropdown").val() == "W30" ) {
  diceRND = dice.slice(0, 30);
  $("#dice_h2").text("W30");
}


  /*
  var src = "/dice/" + images[getRandomInt(0, images.length - 1)];
  $("img#randimgw12").prop("src", src);
  */
  // var src = diceRND[getRandomInt(0, diceRND.length - 1)];
  
  
  var src = diceRND[getRandomInt(0, diceRND.length - 1)];
  
  // if stat instead of rnd dice add class to enhance dice img class #randomDiceOut
  // also remove class for the dice
  if ( stat_css == true ) {
    
    // console.log("STATS");
      
    $( "#randomDiceOut" ).addClass( "stat" );
    
    // $( "img#statIMG" ).prop( "src", "/img/stats/ds1/"+src+".jpg" );
    // $("#randomDiceOut").html("<img src='/img/stats/ds1/"+src+".jpg'>"+src);
    // $( "img#statIMG" ).prop( "src", "/img/stats/ds1/"+src+".jpg" );
    
    // console.log("_GAME: " + _GAME);
    
    $("#randomDiceOut").html( " <div><img src='/img/stats/"+_GAME+"/"+src+".png' alt='"+src+"'></div><div>" + src + "</div> ");
  } else {
    
    // console.log("DICE");
    
    // remove .stat to show dice symbol bg again
    if ( $("#randomDiceOut").hasClass("stat") ) $( "#randomDiceOut" ).removeClass( "stat" );
    
    $("#randomDiceOut").text(src);
  } 
  
  // Original single output without STATS rolling
  // $("#randomDiceOut").text(src);
  
  console.log("diceRND: " + diceRND);
  console.log("src: " + src);
  
  /*
  $("#status").show();
  $("#status").text(diceRND);
  */
  
  
  
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
  
  // Curse
  } else if (run_rnd == 66) {
    $("#bonfire").hide();
    $("#rerunroll").show();
    // $("#rerunroll").html("<img src='/img/curse.png' width='384' height='320' alt='Curse Basilisk'> <br>" + run_rnd);
    $("#rerunroll").html("<img src='/img/curse.png' width='384' height='320' alt='Curse Basilisk'> <br>");
    play_audio("superaids");
    
  // SUPERAIDS
  } else if (run_rnd == 99) {
    $("#bonfire").hide();
    $("#rerunroll").show();
    $("#rerunroll").html("SUPERAIDS <br>" + run_rnd);
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

// ASSI TONI, STAR WARS UFF PÄLZISCH

// Random audio file
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
  "alwayssunnybell",
  "flanders",
  "frieza",
  "joker",
  "presi1",
  "presi2",
  "presi3",
  "presi4",
  "presi5",
  "presi6",
  "presi7",
  "rlmwhistle"
];
  
/*
  "werner1",
  "werner2",
  "werner3",
  "werner4",
  "werner5",
  "werner6",
  "werner7",
  "werner8",
  "werner9",
  "werner10",
  "werner11",
  "werner12",
  "werner13",
  "werner14",
  "werner15",
  "werner16",
  "werner17",
  "werner18",
  "werner19",
  "werner20",
  "werner21",
  "werner22",
  "werner23",
  "werner24",
  "werner25",
  "werner26",
  "werner27"

*/

  
  
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
  
  console.log(audio_files);
  
  var src = audio_files[getRandomInt(0, audio_files.length - 1)];
  
  // Debug
  // var src = audio_files[48];
  
  // $("img#randimgw12").prop("src", src);
  
  /*
  $("#status").show();
  $("#status").text(src);
  */
  
  console.log(src);
  
  play_audio(src);

} // ENDFUNCTION
</script>

<!-- Play Audio -->
<script>
  function play_audio (source) {
    
    // set html via jquery
    // $("#element").html("<audio autoplay><source src=\"" + thisSound + "\" type=\"audio/mpeg\"><embed src=\"" + thisSound + "\" hidden=\"true\" autostart=\"true\" /></audio>");
        
    var myAudio = document.getElementById("audio_"+source);
    
    if (source == "shrine") {
      
      if (myAudio.paused) {
        myAudio.play();
        $(".play").html("&#10074;&#10074;"); // Pause Button
      } else {
        myAudio.pause();
        $(".play").html("&#9658;"); // Play button
      }
      
    } else {
      myAudio.play();
    } // END IF SHRINE
    
    
    /*
    // Loop Timer
    // loop only x amount of time (maxPlay) to solve problem with stopping audio when timer is active
    var played = 0;
    var maxPlay = 3;
    
    myAudio.onplay = function() {
      // played counter
      played++;
    };

    // Loop
    $(myAudio).bind("ended", function() {
      if ( // don't loop these audio files
          source !== "dice" &&
          source !== "bier" &&
          source !== "superaids" &&
          source !== "vader" &&
          source !== "aids" &&
          source !== "Biber" &&
          source !== "Katz" &&
          source !== "Pat"
         ) {
        // reset to start point
        myAudio.currentTime = 0;
        if (played < maxPlay) {
          // myAudio.play();
          setTimeout(function() { myAudio.play() }, 2000); // 1250
        } else {
          played = 0;
        }

      }
    });
    */
  
  } // ENDFUNCTION
</script>

<!-- Stop Audio --> 
<script>
function stopAllAudio() {
  var all_audio = document.getElementById("audio").querySelectorAll("audio");
  
	all_audio.forEach(function(audio){
		audio.pause();
	});
}
  

function stop_audio () {
  var all_audio = document.getElementById("audio").querySelectorAll("audio");
  // console.log(all_audio);
  
  
  // global audio_files; @randomSoundEffect()
  var i;
  var src;
  
  /*
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
  */

  // Get all audio by reading every audio Tag instead of audio_files array from random_sound()
  for (i = 0; i < all_audio.length; i++) {
    // src = audio_files[i] + ".mp3";
    src = all_audio[i];
    // src = document.getElementById(src)
    
    // alert(src);
    // console.log(src);
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
  
<!-- JS readdir -->
<script>
var files = <?php $out = array();

$files = scan_dir("audio/werner");
  foreach ($files as $key => $value) {
    // echo $value . "<br>";
    $out[] = $value;
  }
      
echo json_encode($out); ?>;

// alert (files);
function json_test () {
  $("#json").toggle();
  $("#json").text(files);
}
</script>
  
<!-- Ajax Delete -->
<script>
$(document).ready(function () {
  $(".aidsListAjaxDel").click(function() {
    var delcart = $(this).data("value");
    var deltable = $(this).data("table");
    
        if (confirm("Are you sure want to delete?")) {
          $.ajax({
              type: "POST",
              url: "del.ajax.php",
              data: {ID : delcart, table : deltable},
              success: function (data) {
                  if (data) {
                      // alert(data);
                      // console.log(data);
                      // window.location.reload();
                        // delete HTML instead of load()
                        // $("tr[id="+delcart+"]").remove();
                        // $("tr[id="+deltable+"-"+delcart+"]").fadeOut();
                        $("li[id='table:"+deltable+":id:"+delcart+"']").fadeOut();
                        
                        /*
                        $(".delete").on("click",function() { 
                          $(this).closest("tr").remove();
                          return false;
                        });
                        */
                    
                    
                    
                      } else {
                        // alert ("OHJE");
                      }
                        // $("#aidsList").load("aids.edit.ajax.php");
                      }
                      });
        }
        // alert($(this).data('value'));
        });
});
</script>
 
<!-- RNG Hover -->
<script>
function showRNG () {
  
  $("#mobsRNG, #bossRNG").toggle();
  $("#mobsRNGNumber, #bossRNGNumber").toggle();
  
}

/*
$( "#mobsRNG, #bossRNG, #mobsRNGNumber, #bossRNGNumber" ).click(function() {
  alert( "Handler for .click() called." );
});
*/

</script>

<!-- Change Game -->
<script>
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