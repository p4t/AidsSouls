<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="modify_records.js"></script>
</head>
<body>
<div id="wrapper">

<?php
$host="localhost";
$username="aids";
$password="kUk3t1%5";
$databasename="aids";
$connect=mysql_connect($host,$username,$password);
$db=mysql_select_db($databasename);

$select =mysql_query("SELECT * FROM weapons");
?>

<table align="center" cellpadding="10" border="1" id="user_table">
<tr>
<th>ID</th>
<th>NAME</th>
<th></th>
</tr>
<?php
while ($row=mysql_fetch_array($select)) 
{
 ?>
 <tr id="row<?php echo $row['weaponID'];?>">
  <td id="name_val<?php echo $row['weaponID'];?>"><?php echo $row['weaponID'];?></td>
  <td id="age_val<?php echo $row['weaponID'];?>"><?php echo $row['weaponName'];?></td>
  <td>
   <input type='button' class="edit_button" id="edit_button<?php echo $row['weaponID'];?>" value="edit" onclick="edit_row('<?php echo $row['weaponID'];?>');">
   <input type='button' class="save_button" id="save_button<?php echo $row['weaponID'];?>" value="save" onclick="save_row('<?php echo $row['weaponID'];?>');">
   <input type='button' class="delete_button" id="delete_button<?php echo $row['weaponID'];?>" value="delete" onclick="delete_row('<?php echo $row['weaponID'];?>');">
  </td>
 </tr>
 <?php
}
?>

<tr id="new_row">
 <td><input type="text" id="new_name"></td>
 <td><input type="text" id="new_age"></td>
 <td><input type="button" value="Insert Row" onclick="insert_row();"></td>
</tr>
</table>

</div>
</body>
</html>