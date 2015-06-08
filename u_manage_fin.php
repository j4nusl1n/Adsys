<!DOCTYPE html>
<?php session_start(); ?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/style.css">
<script>
<?php
	if(!isset($_SESSION['current_uid']))
		echo "var notAvailable=1;";
?>
	if(notAvailable){
		window.open("index.html", "_self");
		alert("Login First!");
	}
</script>
</head>
<body>
<div id="header">
<div id="menu">
<ul id="nav">
<?php
	if($_SESSION['isadmin']==1){
		echo "<li><a href='a_manage.php' style='width:15em'>Advertisement Management</a></li>";
		echo "<li><a href='b_manage.php' style='width:12em'>Beacon Management</a></li>";
		echo "<li><a href='u_manage.php' style='width:12em'>User Management</a></li>";
	}
	else{
		echo "<li><a href='a_manage.php' style='width:15em'>Advertisement Management</a></li>";
		echo "<li><a href='beaconlist.php'>Beacon List</a></li>";
		echo "<li><a href='acc_manage.php' style='width:12em'>Account Management</a></li>";
	}
?>
	<li><a href="logout.php">Log Out</a></li>
</ul>
</div>
</div>
<div id="content">
<?php
	include("mysqlconnect.inc.php");
	
	$del_uid=$_GET['uid'];
	$sql="delete from users where uid=$del_uid";
	$result=mysqli_query($con, $sql) or die("Error:".mysqli_error($con));
	echo "User $del_uid Delete Success!<br/>";
	echo "<button onclick='window.close()'>Close</button>";
	
	mysqli_close($con);
?>
</div>
</body>
</html>