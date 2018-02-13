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
<meta name="theme-color" content="#3f292b">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
  
<title>\[T]/</title>

<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Tangerine">
<link rel="stylesheet" href="layout.css" type="text/css" media="screen">
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
    
  var x   = document.getElementById("w12");

  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
    
    // document.getElementById("randimgw12").src = diceImages[getRandomInt(0, diceImages.length - 1)];
    document.getElementById("randimgw12").src = "dice/" + images[getRandomInt(0, images.length - 1)];
    
  } 
</script>
  
<script>
  // roll dice 1-100, display yes if dice is either 77 or 7
  function rerun() {

    var rnd = Math.floor((Math.random() * 100) + 1)
    var x   = document.getElementById("rerunroll");

      if (x.style.display === "none") {
          x.style.display = "block";
      } else {
        x.style.display = "none";
      }
    
    // if (rnd > 1) { // DEBUG
    if (rnd == 7 || rnd == 77) {
      document.getElementById("rerunroll").innerHTML = "👍" + "<br>" + rnd;
    } else {
      document.getElementById("rerunroll").innerHTML = "¯\\_(ツ)_/¯" + "<br>" + rnd;
      
      if (x.style.display === "block") play_haha();
    } 
  }


</script> 

<script>
  function play_haha() {
    var audio = document.getElementById("audio_haha");
    audio.play();
  }

  function play_Biber() {
    var audio = document.getElementById("audio_Biber");
    audio.play();
  }
  
  function play_Katz() {
    var audio = document.getElementById("audio_Katz");
    audio.play();
  }

  function play_Pat() {
    var audio = document.getElementById("audio_Pat");
    audio.play();
  }
</script>
  

</head>

<body>

<div class="container">

  <div class="header">
    <!-- <img src="img/ds2_logo.png" alt="Dark Souls II Aids" width="630" height="80" class="headerImage"> -->
    <img src="img/ds3_logo.png" alt="Dark Souls III Aids" width="661" height="80" class="headerImage">
    <h4>mit verschärftem AIDS</h4>
  </div>

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

    <div>
      <img src="dice/<?= $mobsRNG ?>.png" width="100" height="100" alt="<?= $mobsRNG ?>">
    </div>

  </div>


  <!-- middle dummy; bonfire -->
  <div class="flex-item-aids">
    <img src="img/WeirdTepidChital-max-1mb.gif" width="172" height="236" alt=""/>
  </div> 


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

    <div>
      <img src="dice/<?= $bossRNG ?>.png" width="100" height="100" alt="<?= $bossRNG ?>">
    </div>


  </div>
</div><!-- EOF flex-container-aids -->

  
<div id="flex-container-aids">
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
  
  
  
<!-- 
---- BUTTONS 
-->
<div id="flex-container-roll">
  
  <!-- Reroll / Reload page -->
  <div class="flex-item">
    <button class="button" onClick="window.location.reload()">
      <span>Reroll</span>
    </button>   
  </div>
  
  <!-- w12 -->
  <div class="flex-item">
    <button class="button" onClick="pickimg()">
      <span>W12</span>
    </button> 
    <!-- <a href="#" onClick="pickimg()"><img src="dice/0.png" id="randimgw12" width="100" height="100" alt="Dice 0"></a> -->
  </div>
  
  <!-- Rerun? -->
  <div class="flex-item">
      <button class="button" onClick="rerun()">
        <span>Rerun</span>
      </button>
  </div>
 
</div>
  
  
  
<!-- Rerun output -->
<audio id="audio_haha" src="audio/SadTrombone.mp3" ></audio>
<div class="rerunFont" id="rerunroll" style="display: none;"></div>
  
<!-- w12 output -->
<div class="w12Font" id="w12" style="display: none;">
    <img src="dice/0.png" id="randimgw12" width="100" height="100" alt="Dice 0">
</div>


</div><!-- EOF aidscontent -->


<hr>

    
<div id="flex-container-aidsListing" class="aidsListing">
  <div class="flex-item"><h3>Mobs</h3><?= displaySQLContent("mobs") ?></div>
  <div class="flex-item"><h3>Boss</h3><?= displaySQLContent("boss") ?></div>
  <div class="flex-item"><h3>Waffen</h3><?= displaySQLContent("weapons"); ?></div>
</div>

  
<hr>

<!-- AUDIO -->
<audio id="audio_Biber" src="audio/biber.mp3"></audio>
<audio id="audio_Katz" src="audio/meow.mp3"></audio>
<audio id="audio_Pat" src="audio/Pat.mp3"></audio>

<!-- Kills Table -->
<div class="killedBosses">
  <h5>Kills</h5>
  <table>
    <thead>
      <tr>
        <th>Kaschber</th>
        <th>Joker</th>
        <th><s>Joker</s></th>
        <th>Kills</th>
      </tr>
    </thead>
    <tbody>
           
<?php
/* Get Boss Kills from SQL, display table */

$stmt = $pdo->prepare("SELECT * FROM kills");
$stmt->execute();
      
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
?>
  <tr> 
   <td class="emoji">
     <a href="edit.php?mode=kills&ID=<?=$row["ID"]?>" target="_blank" rel="noopener noreferrer" onClick="play_<?=$row["name"]?>()" data-balloon="<?=$row["name"]?>" data-balloon-pos="up">
       <?=replaceNameWithEmoji($row["name"])?>
     </a>
   </td>

   <td>
     <a href="edit.php?mode=kills&ID=<?=$row["ID"]?>" target="_blank" rel="noopener noreferrer" data-balloon="<?=$row["joker"]?>" data-balloon-pos="up">
       <?=numberToTally($row["joker"])?>
     </a>
   </td>

   <td>
     <a href="edit.php?mode=kills&ID=<?=$row["ID"]?>" target="_blank" rel="noopener noreferrer" data-balloon="<?=$row["spent"]?>" data-balloon-pos="up">
       <?=numberToTally($row["spent"])?>
     </a>
   </td>

   <td>
     <?=replaceCheeseWithEmoji( nl2br($row["bossNames"]) )?>
   </td>
  </tr>
<?php
}
?>
 
    </tbody>
  </table>
</div><!-- EOF killedBosses -->
  
  
<!-- BONFIRE -->

<div id="flex-container-footer">
  <div class="flex-item">&nbsp;</div>
  
  <div class="flex-item">
    
    <a href="#"><img src="img/arrow_icon.png" width="30" height="19" alt="To Top"></a>
    <a href="edit.php">Edit</a>
    <a href="#"><img src="img/arrow_icon.png" width="30" height="19" alt="To Top"></a>
    
  </div>
  
  <div class="flex-item">&nbsp;</div>
</div>

  
</div><!-- EOF Content -->
</div><!-- EOF Container -->
  
</body>
</html>


<?php
/* save all aids to file and DB */

$file = "latestAids.txt";
$date = date("Y-m-d H:i:s");
$IP = getRealIpAddr();

$current = file_get_contents($file);

$current .= $IP
          . " - "
          . $date
          . " - "
          . $mobsRNG
          . " - "
          . $bossRNG
          . "\n"
          ;


file_put_contents($file, $current);


//////////////////////////////MYSQL//////////////////
$sql = "INSERT INTO rolls (date, IP, mobs, boss) VALUES (:date, :IP, :mobs, :boss)";
$stmt = $pdo->prepare($sql);                                  
$stmt->bindParam(":date", $date, PDO::PARAM_STR);
$stmt->bindParam(":IP", $IP, PDO::PARAM_STR);
$stmt->bindParam(":mobs", $mobsRNG, PDO::PARAM_INT);
$stmt->bindParam(":boss", $bossRNG, PDO::PARAM_INT);
// $stmt->bindParam(':ID', $_GET['ID'], PDO::PARAM_INT);
$stmt->execute();

// Table/Output in edit.php

?>


<!-- 
<div>
  <? // if ($_SESSION['loggedIn'] === 1): ?>
     <div id="main">Main Menu stuff goes here</div>
  <? // else: ?>
     <div id="main">Please log in...</div>
  <? // endif ?>
</div>
-->

