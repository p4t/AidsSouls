<?php
// SHOW ALL A autocomplete data

// Lib
require_once($_SERVER["DOCUMENT_ROOT"] . "/config.db.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/functions.inc.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/globals.inc.php");

include( "autocomplete.ds1.php" );
$ds1_weapons = $weapons;
include( "autocomplete.ds2.php" );
$ds2_weapons = $weapons;
include( "autocomplete.ds3.php" );
$ds3_weapons = $weapons;
include( "autocomplete.ds1r.php" );
$dsr1_weapons = $weapons;
include( "autocomplete.bb.php" );
$bb_weapons = $weapons;

?>
<pre>
<?php
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
?>
</pre>