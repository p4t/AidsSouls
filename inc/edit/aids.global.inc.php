<?php
$_DR = $_SERVER["DOCUMENT_ROOT"];
include_once($_DR . "/autocomplete/aids.php");

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



<div id="flex-container-autocomplete">


  <!-- Include AIDS array -->
  <div class="flex-container-autocomplete-item">
      <h1>Global Aids</h1>
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
</div>