<?php
// SHOW ALL A autocomplete data
$_DR = $_SERVER["DOCUMENT_ROOT"];
// Lib
require_once($_DR . "/config.db.php");
require_once($_DR . "/functions.inc.php");
require_once($_DR . "/globals.inc.php");
?>

<div style="display: none;">
<?php
// Aids
include_once($_DR . "/autocomplete/aids.php");
?>
</div>
<?
/*
include( $_DR . "/autocomplete/ds1.php" );
$ds1_weapons = $weapons;
include( $_DR . "/autocomplete/ds2.php" );
$ds2_weapons = $weapons;
include( $_DR . "/autocomplete/ds3.php" );
$ds3_weapons = $weapons;
include( $_DR . "/autocomplete/ds1r.php" );
$ds1r_weapons = $weapons;
include( $_DR . "/autocomplete/bb.php" );
$bb_weapons = $weapons;
*/
?>


AIDS | WEAPONS | BOSSES
<br><br><br><br>


<div id="flex-container-autocomplete">


<!-- Include AIDS array -->
<div class="flex-container-autocomplete-item">
    <h1>Aids</h1>
    <ul class="autocomplete">
      <?php
      // $data = $ds1_weapons;
      foreach ($aids as $key => $value ) {
        // echo "<li>" . "Key: " . $key . " Value: " . $value .  "</li>";
        echo "<li contenteditable=\"true\">" . $value . "</li>";
      }
      ?>
    </ul>
</div>






<?php
  // $tables = array("ds1", "ds2", "ds3", "ds1r", "bb");
  // sforeach($tables as $table) :

  /*
  switch ($table) {
      case "ds1":
          $data = $ds1_weapons;
          break;
      case "ds2":
          $data = $ds2_weapons;
          break;
      case "ds3":
          $data = $ds3_weapons;
          break;
      case "ds1r":
          $data = $ds1r_weapons;
          break;
      case "bb":
          $data = $bb_weapons;
          break;

      default:
          echo "ERROR!";
  }
  */

  /* Include Autocomplete Array (Weapons, Boss) depending on _GAME */
  switch (_GAME) {
    case "ds1":
      include( $_DR . "/autocomplete/ds1.php" );
      include( $_DR . "/autocomplete/ds1.bosses.php" );
      break;
    case "ds2":
      include( $_DR . "/autocomplete/ds2.php" );
      include( $_DR . "/autocomplete/ds2.bosses.php" );
      break;
    case "ds3":
      include( $_DR . "/autocomplete/ds3.php" );
      include( $_DR . "/autocomplete/ds3.bosses.php" );
      break;
    case "ds1r":
      include( $_DR . "/autocomplete/ds1r.php" );
      include( $_DR . "/autocomplete/ds1r.bosses.php" );
      break;
    case "bb":
      include( $_DR . "/autocomplete/bb.php" );
      include( $_DR . "/autocomplete/bb.bosses.php" );
      break;

    default:
      echo "ERROR!";
  }
?>


<!-- BOSSES -->
<div class="flex-container-autocomplete-item">
    <h1><?=$GAME?> Bosses</h1>
    <ul class="autocomplete">
      <?php
      // $data = $ds1_weapons;
      foreach ($bosses as $key => $value ) {
        // echo "<li>" . "Key: " . $key . " Value: " . $value .  "</li>";
        echo "<li contenteditable=\"true\">" . $value . "</li>";
      }
      ?>
    </ul>
</div>




<!-- WEAPONS -->
<div class="flex-container-autocomplete-item">
    <h1><?=$GAME?> Weapons</h1>
    <ul class="autocomplete">
      <?php
      // $data = $ds1_weapons;
      foreach ($weapons as $key => $value ) {
        // echo "<li>" . "Key: " . $key . " Value: " . $value .  "</li>";
        echo "<li contenteditable=\"true\">" . $value . "</li>";
      }
      ?>
    </ul>
</div>
<?php
//ENDFOREACH
?>





</div><!-- EOF #flex-container-autocomplete -->




<pre>
<?php
/*
echo "ds1 weapons:<br>";
print_r($ds1_weapons);
echo "ds2 weapons:<br>";
print_r($ds2_weapons);
echo "ds3 weapons:<br>";
print_r($ds3_weapons);
echo "ds1r weapons:<br>";
print_r($ds1r_weapons);
echo "bb weapons:<br>";
print_r($bb_weapons);
*/
?>
</pre>