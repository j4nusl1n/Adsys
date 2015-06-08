<!DOCTYPE html>
<html>
<head><title>Change Password</title>
<link rel="SHORTCUT ICON" href="123.ico">
<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<div id="header"><h1>Change Password</h1></div>
	<div id="content">
	<article>
		<form name="form" method="post" action="pwdre_fin.php">
			<p>Account: <input type="text" name="account"/></p>
			<p>Email: <input type="email" name="mail"/></p>
			<p>Enter New Password: <input type="password" name="pw"/></p>
			<p>Enter Again: <input type="password" name="pw2"/></p>
			<input type="Submit" value="OK"/>
		</form>
	</article>
	<p><a href=index.html>Back to Login Page</a></p>
	</div>
</body>
</html>
<?php
?>