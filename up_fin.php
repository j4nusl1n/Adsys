<!DOCTYPE html>
<?php session_start() ?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<div id="header">
	<h1>Upload Advertisement</h1>
</div>
<?php
	include("mysqlconnect.inc.php");
	if(!isset($_POST['start'])&&!isset($_POST['end'])&&!isset($_POST['ad_content'])){
		echo "<p>Please fill all the blank<br/>";
		echo "<meta http-equiv=REFRESH CONTENT=3;url=main.php>";
	}
	else{
		//echo $_POST['start']."<br/>".$_POST['end']."<br/>".$_POST['ad_content'];
		if($_FILES["file"]["error"]>0){
			echo "<p>Upload fail!<br/>";
			echo "Error Code: ".$_FILES['file']['error']."<br/>";
		}
		else{/*
			echo "File name: ".$_FILES['file']['name']."<br/>";
			echo "File type: ".$_FILES['file']['type']."<br/>";
			echo "File size: ".($_FILES['file']['size']/1024)." KB<br/>";
			echo "Tmp name: ".$_FILES['file']['tmp_name']."<br/>";*/
			date_default_timezone_set("Asia/Taipei");
			$fname=$_FILES['file']['name'];
			$start=$_POST['start'];
			$str=explode("-", $start);
			$start_y=$str[0];
			$start_m=$str[1];
			$start_d=$str[2];
			$start_ts=mktime(0, 0, 0, $start_m, $start_d, $start_y); //echo $start_ts;
			$end=$_POST['end'];
			$str=explode("-", $end);
			$end_y=$str[0];
			$end_m=$str[1];
			$end_d=$str[2];
			$end_ts=mktime(23, 59, 59, $end_m, $end_d, $end_y); //echo "<br/>$end_ts";
			$content=mysqli_real_escape_string($con, $_POST['ad_content']);
			if(file_exists("upload/".$fname)){
				echo "<p>File already exists!<br/>";
			}
			else{
				move_uploaded_file($_FILES['file']['tmp_name'], 'upload/'.$_FILES['file']['name']);
				//echo "<img src='upload/".$_FILES['file']['name']."'>";
				$sql="insert into advertisement (start, end, filename, content, ownby) values ('$start_ts', '$end_ts', '$fname', '$content', ".$_SESSION['current_uid'].")";
				$result=mysqli_query($con, $sql) or die("Error:".mysqli_error($con));
				echo "<p>Upload success!<br/>";
			}
		}
	}
	//echo "   ".$_SESSION['upload_bid'];
	echo "Return to main page in few seconds...</p>";
	echo "<meta http-equiv=REFRESH CONTENT=3;url=main.php>";
	mysqli_close($con);
?>
</body>
</html>