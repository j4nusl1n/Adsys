<!DOCTYPE html>
<?php session_start() ?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/style.css">
<script>
	var notAvailable;
<?php
	if(!isset($_SESSION['current_uid']))
		echo "notAvailable=1;";
?>
	if(notAvailable){
		window.open("index.html", "_self");
		alert("Login First!");
	}
</script>
</head>
<body>
<div id='wrapper'>
<div id="header">
<h1>View Advertisement</h1>
	<div style='position:relative;box-sizing:border-box;bottom:0;'>
	Current User: <?php echo $_SESSION['current_name']; ?>
</div>
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
		<li style='margin-left:5em;'><a href="logout.php" style='background:#ff0000;color:#ffffff;'>Log Out</a></li>
		</ul>
	</div>
</div>
<div id="content">
<?php
	include("include/mysql.inc.php");
	
	$aid=$_GET['aid'];
	$sql="select start, end, filename, content from advertisement where aid=$aid";
	$result=mysqli_query($con, $sql) or die("Error:".mysqli_error($con));
	$row=mysqli_fetch_row($result);
	$content=str_replace("\n", "<br/>", $row[3]);
	echo "<section>";
	date_default_timezone_set("Asia/Taipei");
	echo "<p><h3>Start Date</h3>".date("M-d-Y", $row[0])."</p><p><h3>End Date</h3>".date("M-d-Y", $row[1])."</p><p><h3>Ads Content</h3>$content</p>";
	echo "<p><h3>Ads Image<h3><img src='upload/".$row[2]."' style='height:30%;width:30%'/></p>";
	echo "</section>";
	
	mysqli_close($con);
?>
</div>
<div id='footer'>
<a href='main.php'>Main Page</a>
</div>
</div>
</body>
</html>