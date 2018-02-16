<?php
require_once("config.db.php");
require_once("functions.inc.php");

/*
echo "<pre>";
print_r($_POST);
print_r($_GET);
echo "</pre>";
*/

// $s = preg_replace('![^a-z]!', '', $s); 
?>

<!doctype html>
<html>
<head>
  
<meta charset="utf-8">

<link rel="apple-touch-icon" sizes="180x180" href="/img/favico/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="/img/favico/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/img/favico/favicon-16x16.png">
<link rel="manifest" href="/manifest.json">
<link rel="mask-icon" href="/img/favico/safari-pinned-tab.svg" color="#3f292b">

<meta name="theme-color" content="#3f292b">
<meta name="msapplication-TileColor" content="#3f292b"> 
<meta name="apple-mobile-web-app-status-bar-style" content="#3f292b">

<meta name="mobile-web-app-capable" content="yes">

<meta name="viewport" content="width=device-width,initial-scale=1.0">
  
<title>\[T]/</title>

<link rel="stylesheet" href="css/layout.css" type="text/css" media="screen">
<link rel="stylesheet" href="css/flex.css" type="text/css" media="screen">
<link rel="stylesheet" href="css/button.css" type="text/css" media="screen">
<link rel="stylesheet" href="css/table.css" type="text/css" media="screen">
<link rel="stylesheet" href="css/datatip.css" type="text/css" media="screen">
<link rel="stylesheet" href="css/mobile.css" type="text/css" media="screen">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/balloon-css/0.5.0/balloon.min.css">
  
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

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
    
  var w12   = document.getElementById("w12");
  var bonfire   = document.getElementById("bonfire");

  if (w12.style.display === "none") {
    w12.style.display = "block";
    bonfire.style.display = "none";
    play_audio("dice");
  } else {
    w12.style.display = "none";
    bonfire.style.display = "block";
  }
    
    document.getElementById("randimgw12").src = "dice/" + images[getRandomInt(0, images.length - 1)];
    
  } 
</script>
  
<script>
  // roll dice 1-100, display yes if dice is either 77 or 7
  function rerun() {

    var rnd         = Math.floor((Math.random() * 100) + 1)
    var rerunroll   = document.getElementById("rerunroll");
    var bonfire     = document.getElementById("bonfire");
    var epicsaxguy  = document.getElementById("EpicSaxGuy");
    var vader       = document.getElementById("vader");

      if (rerunroll.style.display === "none") { // wenn würfel ausgabe nicht ausgegeben wird und button gedrückt wird
          rerunroll.style.display = "block"; // button wird gedrückt, zeig würfel output als div: rerun
      } else { // würfel output wenn angezeigt wird und button wieder gedrückt wird
        rerunroll.style.display   = "none"; // verstecke rerun div wieder
        bonfire.style.display     = "block"; // zeige bonfire wieder an
        epicsaxguy.style.display  = "none"; // verstecke Epic Sax Guy Gif
        vader.style.display       = "none"; // verstecke Vader
      }
    
    // rnd = 1; // DEBUG
    if (rnd == 7 || rnd == 77) {
      document.getElementById("rerunroll").innerHTML = "<img src='img/jumpforjoy.png'>" + "<br>" + rnd;
      if (rerunroll.style.display === "block") { // sicherstellen, dass Ton und Gif nur abgespielt werden wenn der Würfel stimmt
        play_audio("yes");
        bonfire.style.display = "none"; // verstecke bonfire
        epicsaxguy.style.display = "block"; // zeige Epic Sax Guy Gif
      }
    } else if (rnd == 1 || rnd == 100) {
      document.getElementById("rerunroll").innerHTML = "<img src='img/stretchout.png'><br>" + rnd;
      
      if (rerunroll.style.display === "block") { // sicherstellen, dass Ton und Gif nur abgespielt werden wenn der Würfel stimmt
        play_audio("no");
        bonfire.style.display = "none"; // verstecke bonfire
        vader.style.display = "block"; // zeige Epic Sax Guy Gif
      }
      
      
    } else { // alles außer 1, 100, 7, 77
      document.getElementById("rerunroll").innerHTML = "¯\\_(ツ)_/¯ <br><img src='img/collapse.png'><br>" + rnd;
      
      if (rerunroll.style.display === "block") { // sicherstellen, dass Ton nur abgespielt wird wenn der Würfel stimmt
        play_audio("haha");
        bonfire.style.display = "none"; // verstecke bonfire
      }
    } 
    
  } // EOF RERUN()


</script> 
  
<script>
  
function reload_page () {
  // window.location.reload();
  location.reload();
}
  
function reroll () {
  play_audio('aids');
  
  setTimeout(function() { reload_page(); }, 1650);
  
}
</script>  

<script>
  function play_audio (source) {
    var myAudio = document.getElementById("audio_"+source);

    if (myAudio.paused) {
      myAudio.play();
    } else {
      myAudio.pause();
    }
  }
</script>
  

</head>

<body>

<div class="container">

  <header>
    <?php
    if ( !empty($_GET["mode"]) && $_GET["mode"] == "rndwpn" ) echo randomWeapon();
    ?>
    <!-- <img src="img/ds2_logo.png" alt="Dark Souls II Logo" width="630" height="80" class="headerImage"> -->
    <img src="img/ds3_logo.png" alt="Dark Souls III Logo" width="661" height="80">
    <h4>mit verschärftem AIDS</h4>
  </header>

<div class="content">
<div class="aidscontent">
<div id="flex-container-aids">

  <div class="flex-item-aids-left">
    <h2>Mobs</h2>
    <?php
    /*******************
    * MOBS             *
    *******************/
    $mobsCount  = pdoCount("mobs");
    $mobsRNG    = mt_rand (1, $mobsCount);
    $mobsRow    = pdoAidsQuery("mobs", $mobsRNG);
    ?>

    <img src="dice/<?=$mobsRNG?>.png" class="dice" width="100" height="100" alt="<?=$mobsRNG?>">
  </div>
  
  <!-- MIDDLE -->
  <!-- bonfire -->
  <div id="bonfire" class="flex-item-aids-bonfire" data-balloon="Firelink Shrine abspielen" data-balloon-pos="up">
    <span class="bonfire">
      <img src="img/WeirdTepidChital-max-1mb.gif" width="172" height="236" alt="" onClick="play_audio('shrine')">
    </span>
  </div>
  
  <!-- w12 output -->
  <div id="w12" style="display: none;">
    <h2>W12</h2>
    <img src="dice/0.png" class="dice" id="randimgw12" width="100" height="100" alt="Dice 0">
  </div>
  
  <!-- EPIC SAX GUY -->
  <div id="EpicSaxGuy" style="display: none;">
    <img src="img/EpicSaxGuy.gif" width="186" height="234" alt="">
  </div>
  
  <!-- Vader -->
  <div id="vader" style="display: none;">
    <img src="img/vader.jpg" width="323" height="203" alt=""> <!-- width="383" height="263" -->
  </div>
  
  <!-- rerunroll -->
  <div class="rerunFont" id="rerunroll" style="display: none;"></div>


  <div class="flex-item-aids-right">
    <h2>Boss</h2>
    <?php
    /*******************
    * BOSS             *
    *******************/
    $bossCount  = pdoCount("boss");
    $bossRNG    = mt_rand (1, $bossCount);
    $bossRow    = pdoAidsQuery("mobs", $bossRNG);
    ?>
    <img src="dice/<?=$bossRNG?>.png" class="dice" width="100" height="100" alt="<?=$bossRNG?>">
  </div>
  
</div><!-- EOF flex-container-aids -->

  
<!-- OUTPUT AIDS TEXT -->
<div id="flex-container-aids-text">
  <div>
    <span class="aidsText">
      <?php
      if ( $mobsRow["name"] == "Zufällige Waffe" ) {
        randomWeapon(); 
      } else {
        echo $mobsRow["name"];
      }
      ?>
    </span>
  </div>

  <div>
    <span class="aidsText">
      <?php
      if ( $bossRow["name"] == "Zufällige Waffe" ) {
        randomWeapon();
      } else {
        echo $bossRow["name"];
      }
      ?>
    </span>
  </div>
</div><!-- EOF flex-container-aids -->
  
  
  
<!-- BUTTONS -->
<div id="flex-container-roll">
  
  <!-- Reroll / Reload page -->
  <div class="flex-item">
    <button class="button" onClick="reroll()">
      <span>Reroll</span>
    </button>   
  </div>
  
  <!-- w12 -->
  <div class="flex-item">
    <button class="button" onClick="pickimg()">
      <span>W12</span>
    </button> 
  </div>
  
  
  <!-- Rerun? -->
  <div class="flex-item">
      <button class="button" onClick="rerun()">
        <span>Rerun</span>
      </button>
  </div>
 
</div>

</div><!-- EOF aidscontent -->

  
  
<hr>
  


<div class="aidsListing">
  <div id="flex-container-aidsListing">
  <?php
  $tables = array("mobs", "boss", "weapons");

  foreach($tables as $table) :
    $table_output = ucfirst($table);
    $stmt = $pdo->prepare("SELECT * FROM $table ORDER BY dice");
    $stmt->execute();
  ?>
    <div class="flex-item-aidsListing">
      <h3><?=$table_output?></h3>
      <ul class="aidsList">
        <?php while ($row = $stmt->fetch(PDO::FETCH_NUM)) : ?>
        <li>
          <a href="edit.php?mode=<?=$table?>&ID=<?=$row[0]?>" target="_blank">
            <?=$row[2]?>
          </a>
        </li>
        <?php ENDWHILE ?>
        <li class="noListStyle" data-tip="Max 32 Chars, hit Enter">
          <form action="edit.php?mode=<?=$table?>&action=add" method="post">
            <span>+</span>
            <input type="text" name="addEntry" value="" size="10" autocomplete="off" maxlength="32" placeholder="..." required="required">
            <!-- <input type="submit" value="Submit"> -->
          </form>
        </li>
      </ul>
    </div>
  <?php
    ENDFOREACH
  ?>
  </div><!-- EOF aidsListing -->
</div><!-- EOF flex-container-aidsListing -->
  


<hr>



<!-- Kills Table -->
<div class="killedBosses">
  <h5>Kills</h5>
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
  // echo "NAME: " . $row["name"] . " Joker - spent = " . $joker . "<br>";
?>
  <tr> 
    
   <td class="emoji">
     <a href="edit.php?mode=kills&ID=<?=$row["ID"]?>" target="_blank" onClick="play_audio('<?=$row["name"]?>')" data-balloon="<?=$row["name"]?>" data-balloon-pos="up">
       <?=replaceNameWithEmoji($row["name"])?>
     </a>
   </td>

   <td>
     <a href="edit.php?mode=kills&ID=<?=$row["ID"]?>" target="_blank" data-balloon="<?=$row["joker"]?>" data-balloon-pos="up">
       <?=numberToTally($row["joker"])?>
     </a>
   </td>

   <td>
     <a href="edit.php?mode=kills&ID=<?=$row["ID"]?>" target="_blank" data-balloon="<?=$joker?>" data-balloon-pos="up">
       <?=replaceIntWithFlasks($joker)?>
     </a>
   </td>

   <td>
     <a href="edit.php?mode=kills&ID=<?=$row["ID"]?>" target="_blank" data-balloon="<?=replaceBrWithComma($row["bossNames"])?>" data-balloon-pos="up">
       <?=replaceCheeseWithEmoji( nl2br($row["bossNames"]) )?>
     </a>
   </td>
    
  </tr>
<?php
ENDWHILE
?>
 
    </tbody>
  </table>
</div><!-- EOF killedBosses -->
    
<footer>
  <p>
    <a href="#"><img src="img/arrow_icon.png" width="30" height="19" alt="To Top"></a>
    <a href="edit.php">Edit</a>
    <a href="#"><img src="img/arrow_icon.png" width="30" height="19" alt="To Top"></a> 
  </p>
</footer>


</div><!-- EOF Content -->
</div><!-- EOF Container -->
  
  
  
<!-- AUDIO -->
<audio id="audio_Biber" src="audio/biber.mp3"></audio>
<audio id="audio_Katz" src="audio/meow.mp3"></audio>
<audio id="audio_Pat" src="audio/Pat.mp3"></audio>
<audio id="audio_haha" src="audio/SadTrombone.mp3"></audio>
<audio id="audio_yes" src="audio/EpicSaxGuy.mp3"></audio>
<audio id="audio_no" src="audio/nooo.ogg"></audio>
<audio id="audio_dice" src="audio/dice.wav"></audio>
<!--<audio id="audio_shrine" src="audio/ds3_firelinkshrine.mp3"></audio>-->
<audio id="audio_shrine" src="audio/DarkSoulsBonfireSoundEffect(cropped).ogg"></audio>
<audio id="audio_aids" src="audio/aids.mp3"></audio>
  
  
<!-- 
<audio autoplay="false" controls="true" loop="true" preload="auto"> 
  <source src="audio/ds3_firelinkshrine.mp3" type="audio/mpeg"></source> 
  Your browser does not support the audio element. 
</audio> 
-->
  
</body>
</html>


<?php
$date = date("Y-m-d H:i:s");
$IP   = getRealIpAddr();
$sql  = "INSERT INTO rolls (date, IP, mobs, boss) VALUES (:date, :IP, :mobs, :boss)";
$stmt = $pdo->prepare($sql);                                  
$stmt->bindParam(":date", $date, PDO::PARAM_STR);
$stmt->bindParam(":IP", $IP, PDO::PARAM_STR);
$stmt->bindParam(":mobs", $mobsRNG, PDO::PARAM_INT);
$stmt->bindParam(":boss", $bossRNG, PDO::PARAM_INT);
$stmt->execute();

// Table/Output in edit.php

?>