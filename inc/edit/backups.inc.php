<?php

$dir    = "myphp-backup-files";


$files = scan_dir($dir);

/*
$files  = scandir($dir);
$files1 = scandir($dir);
$files2 = scandir($dir, 1);
*/

/*
echo "<pre>";
print_r($files);
echo "</pre>";
*/

/*
echo "<pre>";

print_r($files);
print_r($files1);
print_r($files2);

echo "</pre>";
*/
?>
<a id="Backups"></a>

<table class="edit">
  <thead onclick="toggleTable()">
    <tr>
      <th class="th-h accordion" colspan="1">
        &raquo;&nbsp;Backups&nbsp;<span class="toggleTableIndicatorPlus">+</span><span class="toggleTableIndicatorMinus">-</span>
      </th>
    </tr>
    <tr>
      <!-- <th scope="col"><strong>ID</strong></th> -->
      <th scope="col"><strong>File</strong></th>
    </tr>
  </thead>
  <tbody class="toggleTable">
      
  <?php
  foreach ($files as $key => $value) {
    if ( $value == ".." || $value == ".") $value = "LOL";
  ?>
      
  <tr>
    <!-- <td><?php//$key?></td> -->
    <td>
      <a href="/myphp-backup-files/<?=$value?>">
        <?=$value?>
      </a>
    </td>
  </tr>      
  <?php
  }
  ?>
  <tr>
    <td>
      <a href="/backup">Backup erstellen</a>
    </td>
  </tr>
  </tbody>
</table>