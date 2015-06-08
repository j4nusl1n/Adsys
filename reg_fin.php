<!DOCTYPE html>
<?php session_start(); ?>
<html>
<header><title>Registration</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
</header>
<body>
<div id="content">
<?php
	include("include/mysql.inc.php");
	
		$account=$_POST['account'];
		$pw=$_POST['pw'];
		$pw2=$_POST['pw2'];
		$name=$_POST['username'];
		$mail=$_POST['mail'];
		$id=0;
		
		//echo "$account<br>$pw<br>$pw2<br>$address<br>$hid<br>$name<br>$sex<br>$bdate<br>$mail<br>";
		if($account!=null&&$pw!=null&&$pw2!=null&&$pw==$pw2)
		{
			/*$sql="select * from users order by users.uid desc";
			$result=mysqli_query($con, $sql) or die("Error: ".mysqli_error($con));
			$row=mysqli_fetch_row($result);
			if($row!=null)
				$id=$row[2];
			//echo $id+1;
			$id++;
			$id=str_pad($id, 2, '0', STR_PAD_LEFT);*/
			$pwstr=md5($pw);
			//echo "<br> $pwstr<br>";
			$sql="insert into users (username, password, email) values ('$account', '$pwstr', '".mysqli_real_escape_string($con, $mail)."')";
			$result=mysqli_query($con, $sql) or die("Error:".mysqli_error($con));
			//echo $id;
			/*date_default_timezone_set('Asia/Taipei');
			$modtime=date("Y-m-d H:i:s");
			$sql="select uid from users where username='$account'";
			$result=mysqli_query($con, $sql) or die("Error:".mysqli_error($con));
			$row=mysqli_fetch_row($result);
			$uid=$row[0];
			$sql="insert into personal_info (uid, name, sex, birthday, modtime) values ('$id', '$name', '$sex', '$bdate', '$modtime')";
			$result=mysqli_query($con, $sql) or die("Error:".mysqli_error($con));
			//echo $sex;
			*/
			/*$sql="select headid from household where household.hid='$hid'";
			$result=mysqli_query($con, $sql) or die("Error:".mysqli_error($con));
			$row=mysqli_fetch_row($result);
			if($id==$row[0])
				$ishead=1;
			else $ishead=0;*/
			//$sql="insert into pmod_history (uid, name, sex, birthday, modtime) values ('$id', '$name', '$sex', '$bdate', '$hid', '$ishead', '$modtime')";
			//$result=mysqli_query($con, $sql) or die("Error:".mysqli_error($con));
			echo "Registration Success!<br>Back to Login Page...<meta http-equiv=REFRESH CONTENT=3;url=index.php>";
		}
		else
		{
			echo "Registration Fail!";
			echo "<p><img src='asdf.png' height=20% width=20%></p>";
			echo "<meta http-equiv=REFRESH CONTENT=3;url=index.html>";
		}

	mysqli_close($con);
?>
</div>
</body>
</html>
