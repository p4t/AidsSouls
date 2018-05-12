<?php
// Lib
require_once("config.db.php");
require_once("functions.inc.php");
require_once("globals.inc.php");

// DB Hack
// include_once("aids.edit.ajax.php");
// include_once("del.ajax.php");

// Save visits to edit.php into db
saveRolls();


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
?>


<!doctype html>
<html lang="de">
<head>
  
<meta charset="utf-8">
<!-- <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes, user-scalable=yes"> -->
<meta name="viewport" content="width=device-width, initial-scale=1">
  
<title>\[T]/ the Edit</title>
<base href="http://ds.fahrzeugatelier.de">

<link rel="stylesheet" href="/css/layout.css" type="text/css" media="screen">
<link rel="stylesheet" href="/css/flex.css" type="text/css" media="screen">
<link rel="stylesheet" href="/css/button.css" type="text/css" media="screen">
<link rel="stylesheet" href="/css/table.css" type="text/css" media="screen">
<link rel="stylesheet" href="/css/form.css" type="text/css" media="screen">
<link rel="stylesheet" href="/css/mobile.css" type="text/css" media="screen">

<!-- jQuery UI CSS -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<!--
<link rel="stylesheet" href="/css/login.css" type="text/css" media="screen">
-->
  
<link rel="stylesheet" href="/css/balloon.css">
  
<link rel="apple-touch-icon" sizes="180x180" href="/img/favico/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="/img/favico/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/img/favico/favicon-16x16.png">
<link rel="manifest" href="/manifest.json">
<link rel="mask-icon" href="/img/favico/safari-pinned-tab.svg" color="#3f292b">
  
<!-- Font for Edit.php and Input Fields -->
<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">

<meta name="theme-color" content="#3f292b">
<meta name="msapplication-TileColor" content="#3f292b"> 
<meta name="apple-mobile-web-app-status-bar-style" content="#3f292b">

<meta name="mobile-web-app-capable" content="yes">
  
<meta name="google" content="notranslate">
<meta name="application-name" content="Aids Souls Edit">
<meta name="description" content="Roll dice to edit AIDS">
<meta name="robots" content="noindex, nofollow">
<meta name="googlebot" content="noindex, nofollow">
<meta name="google" content="nositelinkssearchbox">
  
<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


<!-- Ajax Delete -->
<script>
$(document).ready(function () {
  $(".delete").click(function() {
    var delcart = $(this).data("value");
    var deltable = $(this).data("table");
    
        if (confirm("Are you sure want to delete?")) {
          $.ajax({
              type: "POST",
              url: "del.ajax.php",
              data: {ID : delcart, table : deltable},
              success: function (data) {
                  if (data) {
                      //alert(data);
                      // window.location.reload();
                        // delete HTML instead of load()
                        // $("tr[id="+delcart+"]").remove();
                        $("tr[id="+deltable+"-"+delcart+"]").fadeOut();
                        
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

</head>

<body spellcheck="false" id="edit">
  
<header>
<!-- <div class="header_Edit"> -->
  <h1>
    &raquo;
    <a href="/">AIDS</a>
    |
    <a href="/edit">EDIT</a>
    &laquo;
  </h1>
<!-- </div> -->
</header>
  



<?php
/*
 * EDIT: MOBS, BOSS, WEAPONS
 */
  if ( !empty($_GET["mode"]) && empty($_GET["action"]) && ($_GET["mode"] == "weapons" || $_GET["mode"] == "mobs" || $_GET["mode"] == "boss") ) {
    (STRING)$mode         = $_GET["mode"];
    (STRING)$table        = _GAME . "_" . $mode;
    (STRING)$parentField  = $table."Name";
    (INT)$ID              = $_GET["ID"];  
  
    if ( isset($_POST["newName"]) ) {
      (STRING)$newName  = $_POST["newName"];
      (STRING)$oldName  = $_POST["oldName"];
      (INT)$newDice     = $_POST["newDice"];
      (INT)$oldDice     = $_POST["oldDice"];
      
      $sql = "UPDATE $table SET name = :name, dice = :dice WHERE ID = :ID";
      $stmt = $pdo->prepare($sql);                                  
      $stmt->bindParam(":name", $_POST["newName"], PDO::PARAM_STR);
      $stmt->bindParam(":dice", $_POST["newDice"], PDO::PARAM_INT);
      $stmt->bindParam(":ID", $_GET["ID"], PDO::PARAM_INT);
      $stmt->execute();
      
      // Copy over weapon image from fextralife
      if ( $mode == "weapons" ) copyWeaponFromFextra($newName);
    
      // log
      if ( $newDice  != $oldDice ) logAction ($table, "Edit", $ID, $parentField , $oldDice, $newDice);
      if ( $newName  != $oldName ) logAction ($table, "Edit", $ID, $parentField, $oldName, $newName);
      
      // redirect("/edit", $statusCode = 303);

    } else {
      
      $stmt = $pdo->prepare("SELECT * FROM $table WHERE ID = ".$_GET["ID"]." ");
      $stmt->execute();
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      
    }
    ?>
  
<div id="flex-container">
  <div class="flex-item">&nbsp;</div>

  <div class="flex-item">
    <form action="/edit?mode=<?= $mode ?>&ID=<?= $_GET["ID"] ?>" method="post" id="edit">
      <ul>
        <li><label>Dice:</label></li>
        <li><input type="number" name="newDice" value="<?=$row["dice"]?>" min="1" max="99" autocomplete="off" placeholder="#" required="required"></li>
        <li><label>Entry:</label></li>
        <li><input type="text" name="newName" id="tags-<?=$mode?>" value="<?=$row["name"]?>" maxlength="32" required="required"></li>
        <li><input type="text" name="fextra" value="" autocomplete="off" maxlength="99" placeholder="Fextra URL"></li>
        
        
        <li><input type="submit" value="Submit"></li>
      </ul>

      <input type="hidden" name="oldDice" value="<?=$row["dice"]?>">
      <input type="hidden" name="oldName" value="<?=$row["name"]?>">
    </form>
  </div>

  <div class="flex-item">&nbsp;</div>
</div>
<?php
} // ENDIF
?>




<?php
/*
 * EDIT: KILLS
 */
if ( !empty($_GET["mode"]) && $_GET["mode"] == "kills" ) {
  (STRING)$mode       = $_GET["mode"];
  (STRING)$table      = _GAME . "_" . $mode;
  (INT)$ID            = $_GET["ID"];
  
  if ( isset($_POST["newJoker"])) {
    (INT)$postJoker   = $_POST["newJoker"];
    (INT)$oldJoker    = $_POST["oldJoker"];
    (INT)$postSpent   = $_POST["newSpent"];
    (INT)$oldSpent    = $_POST["oldSpent"];
    // (STRING)$postName = $_POST["newName"];
    (STRING)$postBoss = $_POST["newBossNames"];
    (STRING)$oldBoss  = $_POST["oldBossNames"];
    
    $sql = "UPDATE {$GAME}_kills SET joker = :joker, spent = :spent, bossNames = :bossNames WHERE ID = :ID";
    $stmt = $pdo->prepare($sql);                                  
    $stmt->bindParam(':joker', $_POST['newJoker'], PDO::PARAM_INT);
    $stmt->bindParam(':spent', $_POST['newSpent'], PDO::PARAM_INT);
    $stmt->bindParam(':bossNames', $_POST['newBossNames'], PDO::PARAM_STR);
    $stmt->bindParam(':ID', $_GET['ID'], PDO::PARAM_INT);
    $stmt->execute();
    
    // log
    if ( $newJoker  != $postJoker ) logAction ($table, "Edit", $ID, "joker", $oldJoker, $postJoker);
    if ( $newSpent  != $postSpent ) logAction ($table, "Edit", $ID, "spent", $oldSpent, $postSpent);
    if ( $newBoss   != $postBoss ) logAction ($table, "Edit", $ID, "bossNames", $oldBoss, $postBoss);
    
    redirect("/edit", $statusCode = 303);
     
  } else {
    $stmt = $pdo->prepare("SELECT * FROM {$GAME}_kills WHERE ID = ".$_GET["ID"]." ");
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
  }
?>

<div id="flex-container">
  <div class="flex-item">&nbsp;</div>
    
  <div class="flex-item">
      <form action="/edit?mode=kills&ID=<?=$_GET["ID"]?>" method="post" id="edit">
        <ul>
          <li><label>Joker:</label></li>
          <li><input type="number" name="newJoker" value="<?=$row["joker"]?>" min="0" max="99" autocomplete="off" placeholder="Joker insgesamt" required="required"></li>

          <li><label>Ausgegeben:</label></li>
          <li><input type="number" name="newSpent" value="<?=$row["spent"]?>" min="0" max="99" autocomplete="off" placeholder="Joker ausgegeben" required="required"></li>

          <li><label>bossNames:</label></li>
          <li><textarea rows="15" name="newBossNames" cols="50" required="required"><?=$row["bossNames"]?></textarea></li>

          <li><input type="submit" value="Submit"></li>
          
        </ul>
        <input type="hidden" name="oldJoker" value="<?=$row["joker"]?>">
        <input type="hidden" name="oldSpent" value="<?=$row["spent"]?>">
        <input type="hidden" name="oldBossNames" value="<?=$row["bossNames"]?>">
      </form>
    </div>
  
  <div class="flex-item">&nbsp;</div>
</div>

<?php
} // ENDIF
?>




<?php
/*
 * EDIT: TODO
 */
if ( !empty($_GET["mode"]) && $_GET["mode"] == "todo" ) {
    (STRING)$mode   = $_GET["mode"];
    (STRING)$table  = _GAME . "_" . $mode;
    (INT)$ID        = $_GET["ID"];  
  
    if ( isset($_POST["newTodo"]) ) {
      (STRING)$newTodo  = $_POST["newTodo"];
      
      $sql = "UPDATE $table SET todoText = :todoText WHERE ID = :ID";
      $stmt = $pdo->prepare($sql);                                  
      $stmt->bindParam(":todoText", $_POST["newTodo"], PDO::PARAM_STR);
      $stmt->bindParam(":ID", $_GET["ID"], PDO::PARAM_INT);
      $stmt->execute();
      
      redirect("/edit", $statusCode = 303);

    } else {
      
      $stmt = $pdo->prepare("SELECT * FROM $table WHERE ID = ".$_GET["ID"]." ");
      $stmt->execute();
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
    }
?>
  
<div id="flex-container">
  <div class="flex-item">&nbsp;</div>
    
  <div class="flex-item">
      <form action="/edit?mode=<?=$mode?>&ID=<?=$_GET["ID"]?>" method="post" id="edit">
        <ul>
          <li><label>Entry:</label></li>
          <li><textarea rows="15" name="newTodo" cols="50" required="required"><?=$row["todoText"]?></textarea></li>
          <li><input type="submit" value="Submit"></li>
        </ul>
      </form>
    </div>
  
  <div class="flex-item">&nbsp;</div>
</div>
  
<?php
} // ENDIF
?>




<?php
/*
 * ADD: MOBS, BOSS, WEAPONS
 */
  if ( !empty($_GET["mode"]) && !empty($_GET["action"]) && ($_GET["mode"] == "weapons" || $_GET["mode"] == "mobs" || $_GET["mode"] == "boss") ) {
    (STRING)$mode   = $_GET["mode"];
    (STRING)$table  = _GAME . "_" . $mode;
    // (INT)$ID        = $_GET["ID"];
  
    if ( isset($_POST["addEntry"]) ) {
      (STRING)$addEntry = $_POST["addEntry"];
      (INT)$addDice     = $_POST["addDice"];
      
      if ( empty($_POST["addDice"]) ) { // if field for dice value wasn't filled
        $stmt = $pdo->prepare("SELECT * FROM $table ORDER BY dice DESC LIMIT 1"); // get max value from field dice
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        (INT)$addDice = $row["dice"] + 1; // +1 of max dice value
      } else { 
        // cherck if dice alrerady exists
        $stmt = $pdo->prepare("SELECT dice FROM $table WHERE dice = $addDice"); // get max value from field dice
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($row["dice"] != NULL ) die("Dice Wert schon vergeben!");
      }    
      
      // Insert Dice Value into DB
      $sql = "INSERT INTO $table (dice, name) VALUES (:dice, :name)";
      $stmt = $pdo->prepare($sql);          
      $stmt->bindParam(':dice', $addDice, PDO::PARAM_INT);
      $stmt->bindParam(':name', $_POST['addEntry'], PDO::PARAM_STR);
      $stmt->execute();

      // Copy over weapon image from fextralife
      if ( $mode == "weapons" ) copyWeaponFromFextra($addEntry);
      
      // redirect("/edit", $statusCode = 303);

    } // ENDIF (ELSE) $_POST["addEntry"]
    
  } // ENDIF $_GET["mode"]
?>



<?php
/*
 * DELETE
 */
if ( !empty($_GET["action"]) && $_GET["action"] == "delete" ) {
  (STRING)$mode         = $_GET["mode"];
  (STRING)$table        = $mode;
  (STRING)$parentField  = $table . "Name";
  (INT)$ID              = $_GET["ID"];

  $sql = "DELETE FROM $table WHERE ID = :ID";
  $stmt = $pdo->prepare($sql);
  $stmt->bindParam(":ID", $ID, PDO::PARAM_INT);
  $stmt->execute();
  
  // log
  logAction ($table, "Del", $ID, $parentField, "", "");
  
  // Check if number in dice is missing
  /*
  $data = $pdo->query("SELECT dice FROM $table")->fetchAll(PDO::FETCH_COLUMN);
  $missing_number = missing_number($data);
  missing_number($data);
  */ 
  
  $count = pdoCount($table);
  if ( $ID != $count ) {
    $data = $pdo->query("SELECT dice FROM $table")->fetchAll(PDO::FETCH_COLUMN);
    $missing_number = missing_number($data);
    print_r( $missing_number);
  }
  
  
  // $stmt = $pdo->prepare("SELECT dice FROM $table ORDER BY dice DESC LIMIT 1"); // get max value from field dice
  //$stmt = $pdo->prepare("SELECT dice FROM $table WHERE ID = $ID"); // get max value from field dice
  //$stmt->execute();
  //$row = $stmt->fetch(PDO::FETCH_ASSOC);
  //$row["dice"] + 1; // +1 of max dice value
  
  
  
  redirect("/edit", $statusCode = 303);
}
?>



<?php
/*
 * TRUNCATE
 */
if ( !empty($_GET["action"]) && $_GET["action"] == "truncate" ) {
  $sql = "TRUNCATE {$GAME}_rolls";
  $stmt = $pdo->prepare($sql);
  $stmt->execute();
  
  redirect("/edit", $statusCode = 303);
}
?>



<?php
/*
 * CHANGE GAME
 */
if (
  
  ( !empty($_GET["mode"]) && $_GET["mode"] == "selectGame" )
  &&
  // ( !empty($_POST["selectGame"]) )
  ( !empty($_GET["game"]) )
  
   ) {
  // $selectGame = $_POST["selectGame"];
  $selectGame = $_GET["game"];
  
  changeGame($selectGame);
  redirect("/edit");
}
?>

<?php
/*
* OUTPUT CONFIG
*/
if ( empty($_REQUEST) ) :
?>

<div id="config">
  <ul>
    <li>Datenbank: <?=_GAME?></li>
    <li>Login: Disabled</li>
    <li>User: {Admin}</li>
    <!-- <li>Change Game:</li> -->
    <li>
      <select id="selectGame" name="selectGame">
        <option value="ds1"   <?=(_GAME == "ds1")   ? "selected"  :""?>>Dark Souls I</option>
        <option value="ds1r"  <?=(_GAME == "ds1r")  ? "selected"  :""?>>Dark Souls Remastered</option>
        <option value="ds2"   <?=(_GAME == "ds2")   ? "selected"  :""?>>Dark Souls II</option>
        <option value="ds3"   <?=(_GAME == "ds3")   ? "selected"  :""?>>Dark Souls III</option>
        <option value="bb"    <?=(_GAME == "bb")    ? "selected"  :""?>>Bloodborne</option>
      </select>
      <!-- <input type="submit" value="Submit"> --> 
    </li>
  </ul>
</div>


<?php
// CHECK MISSING DICE
checkMissingDice();
?>

  
<script>
$(function(){
  // bind change event to select
  $("#selectGame").on("change", function () {
    // var url = $(this).val(); // get selected value
    var game = $(this).val(); // get selected value
    var url = "/edit?mode=selectGame&game="+game;
    if (url) { // require a URL
        window.location = url; // redirect
    }
    return false;
  });
});
</script>

<?php
ENDIF
?>
  
  
<div id="flex-container-edit">

  


<!-- <div id="aidsList"> -->
<?php
/*
* NO $_REQUEST[]
*/
  // if ( empty($_GET["mode"]) ) :
  if ( empty($_REQUEST) ) :

  $tables = array("mobs", "boss", "weapons");

  foreach($tables as $table) :
    $mode = $table;
    $table = _GAME . "_" . $table;
    $stmt = $pdo->prepare("SELECT * FROM $table ORDER BY dice");
    $stmt->execute();
?>
<a id="<?=ucfirst($table)?>"></a>
<form action="/edit?mode=<?=$mode?>&action=add" method="post">
<table class="edit">
  <thead>
    <tr>
      <th class="th-h" colspan="3">
        &raquo; <?=ucfirst($table)?>
      </th>
    </tr>
    
    <tr>
      <th scope="col"><strong>Dice</strong></th>
      <th scope="col"><strong><?=ucfirst($table)?></strong></th>
      <th scope="col"><strong>IMG</strong></th>
      <!-- <th scope="col" class="edit_action"><strong>...</strong></th> -->
    </tr>
  </thead>
  <tbody>
    <?php while ($row = $stmt->fetch(PDO::FETCH_NUM)) : ?>

    <tr id="<?=$table?>-<?=$row[0]?>">
      <td><a href="/edit?mode=<?=$mode?>&ID=<?=$row[0]?>"><?=$row[1]?></a></td>
      <td class="edit_col">
        <div class="title">
          <a href="/edit?mode=<?=$mode?>&ID=<?=$row[0]?>"><?=$row[2]?></a>
          <!-- DELETE -->
          <a data-value="<?=$row[0]?>" data-table="<?=$table?>" class="delete" data-balloon="Löschen" data-balloon-pos="left">
            <img src="/img/delete-icon.png" width="20" height="20" alt="Delete">
          </a>
          <!-- EDIT -->
          <a class="edit-data" href="/edit?mode=<?=$table?>&ID=<?=$row[0]?>" data-balloon="Edit" data-balloon-pos="left">
            <img src="/img/edit-icon.png" class="edit_icon" width="20" height="20" alt="Edit">
          </a>
        </div>
      </td>
      <td>       
        <?php
        if ( $table == _GAME . "_weapons" ) {
          $path = sanitizeWeaponsPath ($row[2]);

          if ( file_exists($_SERVER["DOCUMENT_ROOT"] . $path[2]) ) {
        ?>
            <span class="diceIconPath-font">&#10004;</span>
            <div class="diceIconPath"><img src="<?=$path[2]?>"></div>
            
          <?php
          } else {
          ?>
            <span class="diceIconPath-font">&times;</span>
          <?php
          }
                    
        } else {
          
          $file_name = sanitizeAids($row[2]);
          $path = "/dice/icons/{$file_name}.png";
          //echo $path;
          
          if ( file_exists($_SERVER["DOCUMENT_ROOT"] . $path) ) {
          ?>
            <span class="diceIconPath-font">&#10004;</span>
            <div class="diceIconPath"><img src="<?=$path?>"></div>
            
          <?php
          } else {
          ?>
            <span class="diceIconPath-font">&times;</span>
          <?php
          }
          
        }
        ?>
      </td>
    </tr>
    <?php ENDWHILE ?>
    <tr>
      <td colspan="3">
        <ul style="margin: 10px;">
          <li>
          <input type="number" name="addDice" value="" min="1" max="99" autocomplete="off" placeholder="#">
          <input type="text" id="tags-<?=$mode?>" class="edit_input" name="addEntry" value="" autocomplete="off" maxlength="32" placeholder="Name" required="required">
          <input type="submit" value="Submit">
          </li>
        </ul>
      </td>
    </tr>
  </tbody>
</table>
</form> 

<?php
  ENDFOREACH
?>

<!-- </div> -->

  
<div class="divider">&nbsp;</div>




<?php
  include("inc/kills.inc.php");
  include("inc/todo.inc.php");
  include("inc/backups.inc.php");
  include("inc/rolls.inc.php");
  include("inc/logs.inc.php");
    
  // include("autocomplete/ALLAUTOCOMPLETEDATA.php");
?>


  

<?php
ENDIF // EOF if ( empty($_GET["mode"]) )
?>

</div>
  
  
  


  
<!-- FOOTER -->  
<hr>
  <footer>
    <nav>
      <a href="/edit">&lt;</a> |
      <!-- <a href="/?action=logout">Logout</a> | -->
      <a href="/edit#">^</a>
    </nav>
  </footer>
<hr>


  

<!-- jQuery Autocomplete -->
<script>
$( function() {
  var availableTags = <?php include("autocomplete.jQuery.php")?>;
  var availableTagsMobsBoss = <?php include("autocomplete/aids.php")?>;
  $( "#tags-weapons" ).autocomplete({
    source: availableTags
  });
  $( "#tags-mobs, #tags-boss" ).autocomplete({
    source: availableTagsMobsBoss
  });
} );
</script>


<script>
/*
$( "a" ).click(function( event ) {
  event.preventDefault();
}
*/
  
/*
$(document).ready(function() {
  
  $( ".accordion" ).click(function( event ) {
    event.preventDefault();
    alert("dsfsdfs");
    $(this).toggle();
  }

});
*/
/*
$(document).on('click', '.accordion', function() {
  alert("hello");
});  
*/

function toggleTable () {
  event.preventDefault();
  
  // var flip = 0;

  $(".toggleTable").toggle("slow");
  /*
  if ( $(".toggleTableIndicator").text() === "+") $(".toggleTableIndicator").text("-");
  else $(".toggleTableIndicator").text("+");
  */
  
  $(".toggleTableIndicatorPlus").toggle("slow");
  $(".toggleTableIndicatorMinus").toggle("slow");
  
  
  
  // console.log($(".toggleTableIndicator").text());
  
  
  // $(".toggleTable").toggle();
  
  /*
  if ($(".toggleTableIndicator").length) {
    $(".toggleTableIndicator").remove();
  } else {
    $(".th-h.accordion").append("<span class='toggleTableIndicator'> - </span>");
  }
  */
  
  
  
}
</script>


<!-- Background Image per _GAME -->
<style type="text/css">
  html {
    background: url("/img/bg/<?=$GAME?>.jpg") no-repeat center center fixed;
    
    background-color: black;

    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
  }
</style>

</body>
</html>



<?php
/*
// Session, Login
} else {
  redirect("/", $statusCode = 303);
}
*/
?>