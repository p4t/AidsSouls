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
<hr>
<br><br><br><br><br><br>
<hr>

<a id="Backups"></a>

<table class="edit">
  <thead>
    <tr>
      <th class="th-h" colspan="2">
        &raquo; Backups
      </th>
    </tr>
    <tr>
      <th scope="col"><strong>ID</strong></th>
      <th scope="col"><strong>File</strong></th>
    </tr>
  </thead>
  <tbody>
      
  <?php
  foreach ($files as $key => $value) {
    if ( $value == ".." || $value == ".") $value = "LOL";
  ?>
      
  <tr>
    <td><?=$key?></td>
    <td>
      <a href="/myphp-backup-files/<?=$value?>">
        <?=$value?>
      </a>
    </td>
  </tr>
      
  <?php
  }
  ?>
      
  </tbody>
</table>