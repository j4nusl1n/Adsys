<!DOCTYPE html>
<?php session_start(); ?>
<html>
<head><title>User Management</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
<script>
	function checkDel(uid){
		if(confirm("Delete this user?")==true){
			window.open("u_manage_fin.php?uid="+uid, "", "height=500, width=500, menubar=no");
			setTimeout("window.open('u_manage.php', '_self')", 500);
		}
	}
</script>
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
	<h1>User Management</h1>
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
<h2>User List</h2>
<?php
	include("include/mysql.inc.php");
	
	$sql="select * from users";
	$result=mysqli_query($con, $sql) or die("Error:".mysqli_error($con));
	echo "<table frame='border' rules='all'><tbody>";
	echo "<tr><td>Username</td><td>Email</td><td>Admin</td><td>Modify</td></tr>";
	while($array=mysqli_fetch_array($result)){
		echo "<tr><td>".$array['username']."</td><td>".$array['email']."</td><td>".($array['isadmin']==1?'Admin':'Normal')."</td>";
		echo "<td><button onclick='checkDel(".$array['uid'].")'>Delete</button></td>";
		echo "</tr>";
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