<!DOCTYPE html>
<?php session_start(); ?>
<html>
<head><title>Account Management</title>
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
<script>
	function changeAcc(uid){
		var email, old_pw, new_pw1, new_pw2;
		//email=document.getElementById('email').value;
		old_pw=document.getElementById('old_pw').value;
		new_pw1=document.getElementById('new_pw1').value;
		new_pw2=document.getElementById('new_pw2').value;
		
		var url="acc_fin.php?";
		if(old_pw!=""&&new_pw1!=""&&new_pw2!=""){
			url=url+"uid="+uid+"&oldpw="+old_pw+"&new1="+new_pw1+"&new2="+new_pw2;
			window.open(url, "", "height=500, width=500, menubar=no");
			setTimeout("window.open('acc_manage.php', '_self')", 500);
		}
		else if(old_pw==""&&new_pw1==""&&new_pw2=="") {
			;
		}
		else{
			alert("Please fill the three blank to complete password changing");
			return;
		}
	}
</script>
</head>
<body>
<div id='wrapper'>
<div id='header'>
<h1>Account Management</h1>
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
<section>
<?php
	include("include/mysql.inc.php");
	
	$sql="SELECT username, email FROM users WHERE uid=".$_SESSION['current_uid'];
	$result=mysqli_query($con, $sql) or die("Error:".mysqli_error($con));
	$row=mysqli_fetch_row($result);
	echo "<div>";
	echo "<p><font size='3'>Username</font><br/>$row[0]</p>";
	echo "<p><font size='3'>Email</font><br/>$row[1]</p>";
	echo "<p><font size='3'>Change Password</font></p><p>Old Password:<input type='password' id='old_pw'></p>";
	echo "<p>New Password:<input type='password' id='new_pw1'></p><p>Enter Again:<input type='password' id='new_pw2'></p>";
	echo "<button onclick='changeAcc(".$_SESSION['current_uid'].");'>Change</button>";
	echo "</div>";
	
	mysqli_close($con);
?>
</section>
</div>
<div id='footer'>
<a href='main.php'>Main Page</a>
</div>
</div>
</body>
</html>