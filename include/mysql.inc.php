<?php
	$host="localhost";
	$username="dbuser";
	$password="dbuser";
	$database="adsys";
	
	$con=mysqli_connect($host, $username, $password, $database);
	if(mysqli_connect_error($con))
	{
		echo "Fail to connect to MySQL: ".mysqli_connect_error();
		exit();
	}
?>