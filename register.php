<!DOCTYPE html>
<html>
<head><title>Regist Page</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
<script src='//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js'></script>
<script>
	var xmlHttp;
	function checkRegAcc(str){
		if(str.length==0){
			document.getElementById('txtCheck').innerHTML="";
			return;
		}
		xmlHttp=GetXmlHttpObject();
		if(xmlHttp==null){
			alert("Browser doesn't support HTTP request");
			return;
		}
		var url="checkReg.php";
		url=url+"?q="+str;
		url=url+"&sid="+Math.random();
		xmlHttp.onreadystatechange=stateChanged;
		xmlHttp.open("GET", url, true);
		xmlHttp.send(null);
	}
	function stateChanged()
	{
		if(xmlHttp.readyState==4||xmlHttp.readyState=="complete"){
			document.getElementById("txtCheck").innerHTML=xmlHttp.responseText;
		}
	}
	function GetXmlHttpObject()
	{
		var xmlHttp=null;
		try{
			//Firefox, Opera 8.0+, Safari
			xmlHttp=new XMLHttpRequest();
		}
		catch(e){
			//IE
			try{
				xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
			}
			catch(e){
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
		}
		return xmlHttp;
	}
</script>
</head>
<body>
	<div id="header"><h1>Regist Page</h1></div>
	<div id="content">
	<article>
		<form name="form" method="post" action="reg_fin.php">
			<p>Account: <input type="text" name="account" id='account' onkeyup='checkRegAcc(this.value);'/><span id='txtCheck'></span></p>
			<p>Password: <input type="password" name="pw"/></p>
			<p>Enter Password Again: <input type="password" name="pw2"/></p>
			<p>Name: <input type="text" name="username"/></p>
			<p>Email: <input type="email" name="mail"/></p>
			<input type="Submit" value="Regist"/>
		</form>
	</article>
	<p><a href=index.html>Back to Login Page</a></p>
	</div>
</body>
</html>
<?php
?>