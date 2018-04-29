var files = <?php $out = array();

$files = scan_dir("audio");
  foreach ($files as $key => $value) {
    // echo $value . "<br>";
    $out[] = $value;
  }
      
echo json_encode($out); ?>;