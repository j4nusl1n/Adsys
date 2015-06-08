<!DOCTYPE>
<?php session_start(); ?>
<html>
<head><title>Beacon List</title>
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
	<h1>Beacon List</h1>
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
<div id="content">
	<h1>Beacon List</h1>
<?php
	include("include/mysql.inc.php");
	
	if(isset($_SESSION['current_uid'])){
	
		$sql="select * from beacon";
		$result=mysqli_query($con, $sql) or die("Error:".mysqli_error($con));
		echo "<p><table frame='border' rules='all'><tbody>";
		echo "<tr><td>Beacon ID</td><td>Group</td><td>Assign Ads</td></tr>";
		while($row=mysqli_fetch_row($result)){
			echo "<tr><td>Beacon $row[0]</td><td>".($row[1]==0?'No Group':"Group $row[1]")."</td><td><input type='text'><input type='submit' onsubmit='return checkAssign();' value='Go!'></td></tr>";
		}
		echo "</tbody></table></p>";
	}
	else{
		echo "<p>You Haven't Login Yet!<br/>Return to login page in few seconds...<p>";
		echo "<meta http-equiv=REFRESH CONTENT=3;url='index.html'>";
	}
	
	mysqli_close($con);
?>
</div>
<div id='footer'>
<a href='main.php'>Main Page</a>
</div>
</div>
</body>
</html>