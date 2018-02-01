<?php
$host="localhost";
$username="aids";
$password="kUk3t1%5";
$databasename="aids";

$connect=mysql_connect($host,$username,$password);
$db=mysql_select_db($databasename);

if(isset($_POST['edit_row']))
{
 // $row=$_POST['row_id'];
  $row=$_POST['name_val'];
  $name=$_POST['name_val'];
  $age=$_POST['age_val'];

 mysql_query("update weapons set weaponID='$name',weaponName='$age' where weaponID='$row'");
 echo "success";
 exit();
}

if(isset($_POST['delete_row']))
{
 $row_no=$_POST['name_val'];
 mysql_query("delete from weapons where weaponID='$row_no'");
 echo "success";
 exit();
}

if(isset($_POST['insert_row']))
{
 $name=$_POST['name_val'];
 $age=$_POST['age_val'];
 mysql_query("insert into weapons values('$name','$age')");
 echo mysql_insert_id();
 exit();
}
?>