<!DOCTYPE html>
<?php session_start(); ?>
<html lang="en">
<head><title>Main Page</title>
<link rel="stylesheet" type="text/css" href="css/style.css" media="screen" />
<?php
	include("include/mysql.inc.php");
	
	global $loginFail;
	
	if(!isset($_SESSION['current_uid'])){
		if(isset($_POST['user'])&&isset($_POST['pw'])){
			$account=$_POST['user'];
			$pw=md5($_POST['pw']);
			$sql="SELECT isadmin, uid, username FROM users 
					WHERE username='".mysqli_real_escape_string($con, $account)."' 
					AND password='".mysqli_real_escape_string($con, $pw)."'";
			$result=mysqli_query($con, $sql) or die("Error:".mysqli_error($con));
			$row=mysqli_fetch_row($result);
			if($row!=null){
				$_SESSION['isadmin']=$row[0];
				$_SESSION['current_uid']=$row[1];
				$_SESSION['current_name']=$row[2];
				$loginFail=0;
			}
			else{
				$loginFail=1;
			}
		}
		else
			$loginFail=2;
	}

	mysqli_close($con);
?>
<script type="text/javascript">
	<?php echo "var loginFail=".$GLOBALS['loginFail'].";\n"; ?>
	function checkLogin(){
		if(loginFail==1){
			window.open("index.html", "_self");
			alert("Login Failure!");
		}
		else if(loginFail==2){
			window.open("index.html", "_self");
			alert("Login First!");
		}
	}
</script>
</head>
<script> checkLogin(); </script>
<body>
<div id='wrapper'>
<div id="header"><h1>Main Page</h1>
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
	function showMsg($con){
			echo "<h1>Welcome, ".$_SESSION['current_name']."!</h1>";
			//echo "<section>";
			//showBeacon($con);
			//echo "</section>";
			echo "<section>";
			//showAds($con, $_SESSION['current_uid'], $_SESSION['isadmin']);
			echo "</section>";
	}
	function showBeacon($con){
		$sql="select bid from beacon where haveads=0";
		$result=mysqli_query($con, $sql) or die("Error:".mysqli_error($con));
		echo "<h2>Available Beacons</h2><br/>";
		echo "<table frame='border' rules='all'><tbody>";
		echo "<tr><td>Beacon ID</td><td>Upload Ads</td></tr>";
		while($row=mysqli_fetch_row($result)){
			echo "<tr><td>Beacon $row[0]</td><td><a href=upload.php?bid=$row[0]>Upload</a></td></tr>";
		}
		echo "</tbody></table>";
	}
	function showAds($con, $uid, $isadmin){
		if($isadmin==1)
			$sql="select aid, ownby, bid, 'group' from advertisement";
		else
			$sql="select aid from advertisement where ownby=$uid";
			
		$result=mysqli_query($con, $sql) or die("Error:".mysqli_error($con));
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
				echo "<tr><td>Ad $row[0]</td><td><a href=viewads.php?aid=$row[0]>View</a></td><td><a href=upload.php?aid=$row[0]>Update</a></td><td><input type='text'></td></tr>";
		}
	}
	
	include("include/mysql.inc.php");
	
	showMsg($con);
	
	mysqli_close($con);
?>
</div>
<div id='footer'>
</div>
</div>
</body>
</html>