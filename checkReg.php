<?php
	include("include/mysql.inc.php");
	$quest=$_GET['q'];
	$output=true;
	if(strlen($quest)>0){
		$sql="select username from users";
		$result=mysqli_query($con, $sql) or die("Error:".mysqli_error($con));
		while($row=mysqli_fetch_row($result)){
			if(strtolower($quest)==strtolower($row[0])){
				$output=false;
			}
		}
	}
	if($output==true){
		$response="<font color='green' style='margin-left:3em;'>OK</font>";
	}
	else{
		$response="<font color='red' style='margin-left:3em;'>Used</font>";
	}
	echo $response;
	
	mysqli_close($con);
?>