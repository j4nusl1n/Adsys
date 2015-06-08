<!DOCTYPE html>
<?php session_start(); ?>
<html>
<head><title>Logout</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	Logout successfully!<br/>
	Return to login page in few seconds...<meta http-equiv=REFRESH CONTENT=3;url=index.html>
<?php
	session_destroy();
?>
</body>
</html>