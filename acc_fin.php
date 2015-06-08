<?php
	include("include/mysql.inc.php");
	
	$uid=$_GET['uid'];
	$oldpw=$_GET['oldpw'];
	$new1=$_GET['new1'];
	$new2=$_GET['new2'];
	
	$sql="select password from users where uid=$uid";
	$result=mysqli_query($con, $sql) or die("Error:".mysqli_error($con));
	$row=mysqli_fetch_row($result);
	if($row[0]!=md5($oldpw)){
		echo "<script>alert('Please enter correct password!');</script>";
		echo '<script>window.close();</script>';
	}
	else if($new1!=$new2){
		echo "<script>alert('Enter the same new password');</script>";
		echo "<script>window.close();</script>";
	}
	else{
		$sql="update users set password='".md5($new1)."' where uid=$uid";
		$result=mysqli_query($con, $sql) or die("Error:".mysqli_error($con));
		echo "<script>alert('Password update successfully');</script>";
		echo "<script>window.close();</script>";
	}
	
	mysqli_close($con);
?>