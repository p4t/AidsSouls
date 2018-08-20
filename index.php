<?php
// Lib
require_once( $_SERVER["DOCUMENT_ROOT"] . "/config.db.php" );
require_once( $_SERVER["DOCUMENT_ROOT"] . "/functions.inc.php" );
require_once( $_SERVER["DOCUMENT_ROOT"] . "/globals.inc.php" );

// DB Hack
// require_once("config.db.php");
// require_once("functions.inc.php");
// require_once("globals.inc.php");

// include_once("aids.ajax.php");
// include_once("jquery_post.php");
// include_once("edit.ajax.php");
// include_once("autocomplete.jQuery.php");
// include_once("flex-container-aids.tpl.php");
// include_once("killedBosses.tpl.php");
// include_once("aidsListing.tpl.php");
// include_once("latestRolls.php");

// include_once("aidscontent.ajax.php");
// include_once("roll.inc.php");
// include_once("aids.css.php");

// include_once("/css/login.css");


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

// Main AIDS Handling
$firstPageLoad = "TRUE"; // Set to true so roll.inc.php knows the page has only been loaded once and roll button (ajax) hasn't been used
include_once( $_SERVER["DOCUMENT_ROOT"] . "/roll.inc.php" );
?>

<!doctype html>
<html lang="de">
<head>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
  
<title>\[T]/</title>
<base href="http://ds.fahrzeugatelier.de">
  
<link rel="stylesheet" href="/css/layout.min.css" type="text/css" media="screen">
<link rel="stylesheet" href="/css/flex.min.css" type="text/css" media="screen">
<link rel="stylesheet" href="/css/button.min.css" type="text/css" media="screen">
<link rel="stylesheet" href="/css/table.min.css" type="text/css" media="screen">
<link rel="stylesheet" href="/css/form.min.css" type="text/css" media="screen">
<!--
<link rel="stylesheet" href="/css/messages.css" type="text/css" media="screen">
-->
<?php
  // Enable/Disable CSS ANimations in Edit>>Config for tablet performance
  if ( _CSSANIMATIONS == "TRUE" ) {
?>
<link rel="stylesheet" href="/css/dice_animations.min.css" type="text/css" media="screen">
<?php
  }
?>
<link rel="stylesheet" href="/css/mobile.css" type="text/css" media="screen">

<!-- jQuery UI CSS -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<!-- jQuery Modal -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css">

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
  .modal {
    /* background: transparent; */
    background: rgba(0, 0, 0, 0.5);
  }
  /* Fullscreen spinner on first page load */
  .no-js #loader { display: none;  }
  .js #loader { display: block; position: absolute; left: 100px; top: 0; }
  .se-pre-con {
    position: fixed;
    left: 0px;
    top: 0px;
    width: 100%;
    height: 100%;
    z-index: 9999;
    background: url(/img/spinner.svg) center no-repeat #000;
  }
</style>

<?php
// CSS for special Aids (No HUD, Jäscher + Feige, Invert Controls)
if ( _SFXAIDS == "TRUE" ) include_once( $_SERVER["DOCUMENT_ROOT"] . "/aids.css.php" );
?>

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
<!-- jQuery UI Touch Punch -->
<script src="/js/jquery.ui.touch-punch.min.js"></script>

<!-- jQuery Modal -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>

<!-- Ajax Loading Animation -->
<script src="/js/ajax-loading.js"></script><!-- https://github.com/toplan/ajax-loading-animation -->

</head>


<body spellcheck="false">

<!-- Fullscreen Ajax Loading Spinner div -->
<div class="se-pre-con"></div>


<!-- SIDENAV -->
<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">
    <!-- &times; -->
    <i class="fas fa-times"></i>
  </a>

  <span class="sidenav-toplink">
    <a href="/edit" target="_blank" data-balloon="Edit" data-balloon-pos="up">
      Edit <i class="fas fa-external-link-alt"></i>
    </a>
  </span>

  <a href="#" id="Aids" onClick="return false">Aids</a>
  <a href="#" id="Kills" onClick="return false">Kills</a>
  <a href="/latestRolls.php" rel="modal:open">Zuletzt gewürfelt</a>
  
  <a href="#" id="aidsAJAXTest" onClick="return false">AJAXAids</a>
  
  <span>&nbsp;</span>

  <a href="/edit?show=config" target="_blank">
    <i class="fas fa-cog"></i>
  </a>
</div>

<span id="sidenav-icon" class="sidenav-icon" onclick="openNav()">
  <!-- &#9776; --> <!-- Menü -->
  <i class="fas fa-bars"></i>
</span>


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

<div class="aidscontent" id="aidscontent">

<div id="aidsAJAX">

<?php
  //$mobsRNG = 0;
  //$bossRNG = 0;
  //$mobsRNG_Output = 0;
  //$bossRNG_Output = 0;
  
  include_once( $_SERVER["DOCUMENT_ROOT"] . "/flex-container-aids.tpl.php" ); // aids output HTML
?>

</div>
  
<!-- !!!BUTTONS -->
<div id="flex-container-roll">
  
  <!-- Reroll / Reload page -->
  <div class="flex-item-button">
    <button class="button" onClick="reroll()" id="reroll_button">
      <span id="reroll_switch_button">Roll</span>
    </button>
  </div>
  
  <!-- W12 -->
  <div class="flex-item-button">
    <select id="dice_dropdown" name="dice_dropdown" class="custom-select dice_dropdown" placeholder="🎲">
      <option value="W1">Stats</option>
      <option value="W6">W6</option>
      <option value="W12" selected>W12</option>
      <option value="W20">W20</option>
      <option value="W30">W30</option>
    </select>
  </div>
  
  <!-- Rerun? -->
  <div class="flex-item-button">
    <button class="button disabled" onClick="rerun()" id="rerun_button" disabled>
      <span id="rerun_switch_button" class="disabled">Rerun?</span>
    </button>
  </div>

</div><!-- EOF #flex-container-roll-->


</div><!-- EOF aidscontent -->
  
  
<!-- <hr> -->


<!-- !!!LIST OF ALL THE AIDS: MOBS BOSS, WEAPONS -->
<div id="aidsListing">
  <!-- aidsListing.tpl.php -->
</div>



<!-- <hr> -->
  

<!-- !!!KILLS -->
<div id="killedBosses">
  <!-- killedBosses.tpl.php -->
</div>

  
<!-- Ajax Success Msg fixed -->
<div id="status">&nbsp;</div>

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

  
  
  <!-- Scheissendreck -->
  <audio preload="none" id="audio_dolphin"               src="/audio/dolphin.mp3"></audio>
  <audio preload="none" id="audio_evillaugh"             src="/audio/evillaugh.mp3"></audio>
  <audio preload="none" id="audio_hagay"                 src="/audio/hagay.mp3"></audio>
  <audio preload="none" id="audio_hahaha(nelson)"        src="/audio/hahaha(nelson).mp3"></audio>
  <audio preload="none" id="audio_sadmusic"              src="/audio/sadmusic.mp3"></audio>
  <audio preload="none" id="audio_sadmusic2"             src="/audio/sadmusic2.mp3"></audio>
  <audio preload="none" id="audio_zackgalifianakislaugh" src="/audio/zackgalifianakislaugh.mp3"></audio>
  <audio preload="none" id="audio_alwayssunnybell"       src="/audio/alwayssunnybell.mp3"></audio>
  

  <!-- The Room -->
  <audio preload="none" id="audio_Cheep_1"             src="/audio/TheRoom/Cheep_1.mp3"></audio>
  <audio preload="none" id="audio_Cheep_2"             src="/audio/TheRoom/Cheep_2.mp3"></audio>
  <audio preload="none" id="audio_IDidNotHitHer"       src="/audio/TheRoom/IDidNotHitHer.mp3"></audio>
  <audio preload="none" id="audio_JustAChickenCheep"   src="/audio/TheRoom/JustAChickenCheep.mp3"></audio>
  <audio preload="none" id="audio_TearingMeApartLisa"  src="/audio/TheRoom/TearingMeApartLisa.mp3"></audio>
  <audio preload="none" id="audio_TommyLaugh_1"        src="/audio/TheRoom/TommyLaugh_1.mp3"></audio>
  <audio preload="none" id="audio_TommyLaugh_2"        src="/audio/TheRoom/TommyLaugh_2.mp3"></audio>
  <audio preload="none" id="audio_TommyLaugh_3"        src="/audio/TheRoom/TommyLaugh_3.mp3"></audio>
  <audio preload="none" id="audio_WhyWhyLisa"          src="/audio/TheRoom/WhyWhyLisa.mp3"></audio>
  <audio preload="none" id="audio_YouMustBeKidding"    src="/audio/TheRoom/YouMustBeKidding.mp3"></audio>
  
  
  <!-- WoWQuote -->
  <audio preload="none" id="audio_200Puls"                   src="/audio/WoWQuote/200Puls.mp3"></audio>
  <audio preload="none" id="audio_badesalz1"                 src="/audio/WoWQuote/badesalz1.mp3"></audio>
  <audio preload="none" id="audio_badesalzWAS"               src="/audio/WoWQuote/badesalzWAS.mp3"></audio>
  <audio preload="none" id="audio_draufdruecken"             src="/audio/WoWQuote/draufdruecken.mp3"></audio>
  <audio preload="none" id="audio_drecksack"                 src="/audio/WoWQuote/drecksack.mp3"></audio>
  <audio preload="none" id="audio_gehtdicheinscheissdreckan" src="/audio/WoWQuote/gehtdicheinscheissdreckan.mp3"></audio>
  <audio preload="none" id="audio_kotzinstreppenhaus"        src="/audio/WoWQuote/kotzinstreppenhaus.mp3"></audio>
  <audio preload="none" id="audio_mimimi"                    src="/audio/WoWQuote/mimimi.mp3"></audio>
  <audio preload="none" id="audio_mundstuhl"                 src="/audio/WoWQuote/mundstuhl.mp3"></audio>
  <audio preload="none" id="audio_blamage"                   src="/audio/WoWQuote/blamage.mp3"></audio>
  <audio preload="none" id="audio_scheisse"                  src="/audio/WoWQuote/scheisse.mp3"></audio>
  <audio preload="none" id="audio_schwarzerbildschirm"       src="/audio/WoWQuote/schwarzerbildschirm.mp3"></audio>
  <audio preload="none" id="audio_wernerflasche"             src="/audio/WoWQuote/wernerflasche.wav"></audio>
  <audio preload="none" id="audio_cundflicht"                src="/audio/WoWQuote/cundflicht.mp3"></audio>
  
  
  <!-- Presi -->
  <audio preload="none" id="audio_presi1"  src="/audio/random/presi1.mp3"></audio>
  <audio preload="none" id="audio_presi2"  src="/audio/random/presi2.mp3"></audio>
  <audio preload="none" id="audio_presi3"  src="/audio/random/presi3.mp3"></audio>
  <audio preload="none" id="audio_presi4"  src="/audio/random/presi4.mp3"></audio>
  <audio preload="none" id="audio_presi5"  src="/audio/random/presi5.mp3"></audio>
  <audio preload="none" id="audio_presi6"  src="/audio/random/presi6.mp3"></audio>
  <audio preload="none" id="audio_presi7"  src="/audio/random/presi7.mp3"></audio>
  
  
  <!-- Werner -->
  <!--
  <audio preload="none" id="audio_werner1"     src="/audio/werner/Wo.mp3"></audio>
  <audio preload="none" id="audio_werner2"     src="/audio/werner/Wieso.mp3"></audio>
  <audio preload="none" id="audio_werner3"     src="/audio/werner/WelchenSchluessel.mp3"></audio>
  <audio preload="none" id="audio_werner4"     src="/audio/werner/Waslos.mp3"></audio>
  <audio preload="none" id="audio_werner5"     src="/audio/werner/Verscheidenes.mp3"></audio>
  <audio preload="none" id="audio_werner6"     src="/audio/werner/SchoenWaschiWaschimachen.mp3"></audio>
  <audio preload="none" id="audio_werner7"     src="/audio/werner/Ruelps.mp3"></audio>
  <audio preload="none" id="audio_werner8"     src="/audio/werner/RoehrichFurz.mp3"></audio>
  <audio preload="none" id="audio_werner9"     src="/audio/werner/Matratzeee.mp3"></audio>
  <audio preload="none" id="audio_werner10"    src="/audio/werner/Kaaaaaaaanzler.mp3"></audio>
  <audio preload="none" id="audio_werner11"    src="/audio/werner/Kissen.mp3"></audio>
  <audio preload="none" id="audio_werner12"    src="/audio/werner/AlleseinDurcheinander.mp3"></audio>
  <audio preload="none" id="audio_werner13"    src="/audio/werner/Bettenmachen.mp3"></audio>
  <audio preload="none" id="audio_werner14"    src="/audio/werner/Jaaaahaaaaaaaaa.mp3"></audio>
  <audio preload="none" id="audio_werner15"    src="/audio/werner/IchbrauchdenSchluessel.mp3"></audio>
  <audio preload="none" id="audio_werner16"    src="/audio/werner/HerrBiernot.mp3"></audio>
  <audio preload="none" id="audio_werner17"    src="/audio/werner/FuernHeizungskeller.mp3"></audio>
  <audio preload="none" id="audio_werner18"    src="/audio/werner/Ellllllfriiiiiiiede.mp3"></audio>
  <audio preload="none" id="audio_werner19"    src="/audio/werner/Elfriiiiiiede.mp3"></audio>
  <audio preload="none" id="audio_werner20"    src="/audio/werner/Eieieiwoisserdenn.mp3"></audio>
  <audio preload="none" id="audio_werner21"    src="/audio/werner/Eckaaaaaat.mp3"></audio>
  <audio preload="none" id="audio_werner22"    src="/audio/werner/Decke.mp3"></audio>
  <audio preload="none" id="audio_werner23"    src="/audio/werner/DaobenbeiFrauHansen.mp3"></audio>
  <audio preload="none" id="audio_werner24"    src="/audio/werner/JedenMorgendasselbeTheater.mp3"></audio>
  <audio preload="none" id="audio_werner25"    src="/audio/werner/Rohrbruch.mp3"></audio>
  <audio preload="none" id="audio_werner26"    src="/audio/werner/Krankenhaus.mp3"></audio>
  <audio preload="none" id="audio_werner27"    src="/audio/werner/Furz.mp3"></audio>
  -->
  
  
  <!-- Random -->
  <audio preload="none" id="audio_flanders"                src="/audio/random/flanders.mp3"></audio>
  <audio preload="none" id="audio_frieza"                  src="/audio/random/frieza.mp3"></audio>
  <audio preload="none" id="audio_joker"                   src="/audio/random/Joker_Laughing.mp3"></audio>
  <audio preload="none" id="audio_rlmwhistle"              src="/audio/random/rlmwhistle.mp3"></audio>
  <audio preload="none" id="audio_MorningStarAids"         src="/audio/system/MorningStarAids.mp3"></audio>
  <audio preload="none" id="audio_fail"            src="/audio/fail.mp3"></audio>
  <audio preload="none" id="audio_bier"            src="/audio/bier.mp3"></audio>
  <audio preload="none" id="audio_richevanslaugh"  src="/audio/richevanslaugh.mp3"></audio>
  
  
  <!-- Shrine Background -->
  <audio preload="none" id="audio_shrine"          src="/audio/DS1_Firelink_Shrine.mp3"></audio>
  
  <!--
  <audio id="audio_shrine"          src="/audio/ds3_firelinkshrine.mp3"></audio>
  <audio id="audio_shrine"          src="/audio/DancingWithTearsInMyEyes.mp3"></audio>
  <audio id="audio_shrine"          src="/audio/DarkSoulsBonfireSoundEffect(cropped).ogg"></audio>
  <audio id="audio_shrine"          src="/audio/DarkSoulsBonfireSoundEffect(cropped)LowerVolume.ogg"></audio>
  <audio id="audio_shrine"          src="/audio/DS1_Firelink_Shrine.mp3"></audio>
  -->
</div>


<!-- JavaScript/jQuery -->
<!--
<script src="/js/global.js"></script>
<script src="/js/ajax.js"></script>
<script src="/js/audio.js"></script>
<script src="/js/rerun.js"></script>
<script src="/js/reroll.js"></script>
<script src="/js/run.js"></script>
<script src="/js/dropdown.js"></script>
<script src="/js/autocomplete.js"></script>
<script src="/js/dice.js"></script>
-->
<script src="/js/scripts.min.js"></script>


<!-- Sidenav -->
<script>
function openNav() {
  $("#mySidenav").css("width", "250px");
  
  $("#sidenav-icon").css({'transform': 'rotate(90deg)'});
}

function closeNav() {
  $("#mySidenav").css("width", "0");
  
  $("#sidenav-icon").css({'transform': 'rotate(0deg)'});
}
</script>

<script>
/* Load aidsListing */
$( "#Aids" ).click(function() {
  console.log( "#Aids clicked" );
    
  $("#aidsListing").hide().load("/aidsListing.tpl.php").fadeIn();
});

/* Load kills */
$( "#Kills" ).click(function() {
  console.log( "#Kills clicked" );
    
  $("#killedBosses").hide().load("/killedBosses.tpl.php").fadeIn();
});
</script>


<!-- Ajax loading spinner -->
<script>
  //init: automatic monitoring ajax events
  var loading = $.loading({
    background : "",
    // minTime    : 2000,
    imgPath    : "/img/spinner.svg",
    imgWidth   : "80px",
    imgHeight  : "80px",
    tip        : ""
  });
</script>


<!-- Preload big images -->
<script>
/*
$( document ).ready(function() {

  $.preloadImages = function() {
    for (var i = 0; i < arguments.length; i++) {
      $("<img />").attr("src", arguments[i]);
    }
  }

  $.preloadImages("/img/EpicSaxGuy.gif", "/img/curse.png", "/img/vader.jpg", "/dice/icons/parry.gif");

});
*/
</script>

<!-- Animated spinner on first page load -->
<script>
$( document ).ready(function() {

  $(".se-pre-con").fadeOut(2000);

});
</script>


</body>
</html>