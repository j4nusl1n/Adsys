<!DOCTYPE html>
<?php session_start(); ?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body style="text-align:center;">
<?php
	include("mysqlconnect.inc.php");
	
	$bid=$_GET['bid'];
	$new_group=$_GET['new_group'];
	$sql="UPDATE beacon SET beacon.group=$new_group WHERE beacon.bid=$bid";
	$result=mysqli_query($con, $sql) or die("Error:".mysqli_error($con));
	echo "Update Success!<br/>";
	echo "<button onclick='window.close();'>Close</button>";
	
	mysqli_close($con);
?>
</body>
</html>