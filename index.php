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
    <?php
    $data = $pdo->query("SELECT * FROM games")->fetchAll(PDO::FETCH_ASSOC);

    foreach ($data as $value) {
    ?>
    <option value="<?=$value["ID"]?>" <?=($value["abbr"] == _GAME) ? "selected" : ""?>><?=$value["name"]?></option>
    <?php
    }
    ?>
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
 
<!-- Custom Select jQuery @Scripts -->


      
    
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

  
<!-- Ajax Success Msg fixed -->
<div id="status">&nbsp;</div>

<!-- FOOTER -->
<hr>
<footer>
  <nav>
    <span>
      User: {Admin} |
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
        $data = $pdo->query("SELECT date, IP, mobs, boss FROM rolls WHERE mobs != '' AND boss != '' AND gameID = $GAMEID ORDER BY ID DESC LIMIT 1, 4")->fetchAll(PDO::FETCH_ASSOC);
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
</div>


<!-- JavaScript/jQuery -->
<script src="/js/ajax.js"></script>
<script src="/js/audio.js"></script>
<script src="/js/rerun.js"></script>
<script src="/js/reroll.js"></script>
<script src="/js/run.js"></script>
<script src="/js/changeGame.js"></script>
<script src="/js/dropdown.js"></script>
<script src="/js/showRNG.js"></script>
<script src="/js/bonfire.js"></script>
<script src="/js/modal.js"></script>
<script src="js/autocomplete.js"></script>


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

<!-- SHOTS -->
<?php
if ( !empty($shots) && $shots == TRUE  ) {
?>  
<script>
"use strict";
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
  
<!-- run.js debug -->
  <?php
  /* run.js Debug */
  /*
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
  */
  ?>


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