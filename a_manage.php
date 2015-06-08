<!DOCTYPE html>
<?php session_start(); ?>
<html>
<head><title>Advertisement Management</title>
<link rel='stylesheet' type='text/css' href='css/style.css'>
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
<div id='header'>
<h1>Advertisement Management</h1>
<div style='position:relative;box-sizing:border-box;bottom:0;'>
	Current User: <?php echo $_SESSION['current_name']; ?>
</div>
<div id='menu'>
	<ul id='nav'>
		<li><a href='a_manage.php' style='width:15em'>Advertisement Management</a></li>
<?php
		if($_SESSION['isadmin']){
			echo "<li><a href='b_manage.php' style='width:12em'>Beacon Management</a></li>";
			echo "<li><a href='u_manage.php' style='width:12em'>User Management</a></li>";
		}
		else{
			echo "<li><a href='beaconlist.php'>Beacon List</a></li>";
			echo "<li><a href='acc_manage.php' style='width:12em'>Account Management</a></li>";
		}
?>
	<li style='margin-left:5em;'><a href="logout.php" style='background:#ff0000;color:#ffffff;'>Log Out</a></li>
	</ul>
</div>
</div>
<div id='content'>
<?php
	include("include/mysql.inc.php");
	
	$isadmin=$_SESSION['isadmin'];
	$uid=$_SESSION['current_uid'];
	
	if($isadmin==1)
		$sql="select aid, ownby, bid, 'group' from advertisement";
	else
		$sql="select aid from advertisement where ownby=$uid";
			
	$result=mysqli_query($con, $sql) or die("Error:".mysqli_error($con));
	echo "<div>";
	if($isadmin==1)
		echo "<h2>Advertisement List</h2>";
	else
		echo "<h2>Uploaded Advertisements</h2>";
		
	echo "<table frame='border' rules='all'><tbody>";
	echo "<tr><td>Advertisement Number</td><td>View</td>".($isadmin==1?"<td>Owned By</td><td>Which Beacon</td><td>Which Group</td>":"<td>Update</td><td>Assign to Group</td>")."</tr>";
	while($row=mysqli_fetch_row($result)){
		if($isadmin==1)
			echo "<tr><td>Ad $row[0]</td><td><a href=viewads.php?aid=$row[0]>View</a></td><td>User $row[1]</td><td>".($row[2]!=0?"Beacon $row[2]":"No Beacon")."</td><td>".($row[3]!=0?"Group $row[3]":"No Group")."</td></tr>";
		else
			echo "<tr><td>Ad $row[0]</td><td><a href=viewads.php?aid=$row[0]>View</a></td><td><a href=upload.php?aid=$row[0]>Update</a></td><td><input type='text'><input type='submit' onsubmit='return checkAssign();' value='Go!'></td></tr>";
	}
	echo "</div>";

	mysqli_close($con);
?>
</div>
<div id='footer'>
<a href='main.php'>Main Page</a>
</div>
</div>
</body>
</html>