<!DOCTYPE html>
<?php session_start(); ?>
<html>
<header><title>Change Password</title>
<link rel="SHORTCUT ICON" href="123.ico">
<style type="text/css">
	a:link {
		text-decoration: none;
		color: #1e90ff;
	}
	a:visited {
		text-decoration: none;
		color: #ff1493;
		
	}
	a:hover {
		text-decoration: underline;
		color: #ff4500;
		cursor: pointer;
	}
</style>
</header>
<body style="font-family:Arial; font-size: large">
<?php
	include("mysqlconnect.inc.php");
	
		$account=$_POST['account'];
		$pw=$_POST['pw'];
		$pw2=$_POST['pw2'];
		$mail=$_POST['mail'];
		$id=0;
		
		//echo "$account<br>$pw<br>$pw2<br>$address<br>$hid<br>$name<br>$sex<br>$bdate<br>$mail<br>";
		if($account!=null&&$pw!=null&&$pw2!=null&&$pw==$pw2)
		{
			$sql="select username, email from users where username='$account' and email='$mail'";
			$result=mysqli_query($con, $sql) or die("Error:".mysqli_error($con));//echo "a";
			$row=mysqli_fetch_row($result);
			if($row==null)
			{
				echo "<p>Please Enter Correct Username and Email!</p>";
				echo "<p><img src='asdf.png' height=20% width=20%></p>";
				echo "<p><a href=index.php>Back to Login Page</a></p>";
			}
			else
			{
				$pwdstr=md5($pw);
				$sql="update users set password='$pwdstr' where username='$account' and email='$mail'";
				$result=mysqli_query($con, $sql) or die("Error:".mysqli_error($con));//echo "b";
				echo "<p>Password Changed! Please Login With New Password!</p>";
				echo "<p><a href=logout.php>Logout</a></p>";
			}
		}
		else
		{
			echo "Password Change Fail!";
			echo "<p><img src='asdf.png' height=20% width=20%></p>";
			echo "<meta http-equiv=REFRESH CONTENT=3;url=index.php>";
		}
	
	mysqli_close($con);
?>
</body>
</html>
