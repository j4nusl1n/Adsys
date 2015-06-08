<!DOCTYPE html>
<?php session_start() ?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/style.css">
<script>
	var isCheckImgType=true;
	var isCheckImgWidth=true;
	var isCheckImgHeight=true;
	var isCheckImgSize=true;
	
	var maxSize=1048576;	// 1 MB;
	var maxHeight=48;
	var maxWidth=48;
	var result=true;
	
	function checkFile(){
		var f=document.FileForm;
		var re= /\.(jpg|png)$/i;
		if(isCheckImgType&&!re.test(f.file.value)){
			alert("Only JPG & PNG file allowed!");
			result=false;
		}
		else{
			var img=new Image();
			img.onload=checkImage();
			img.src=f.file.value;
		}
		return result;
	}
	
	function checkImage(){
		if(isCheckImgWidth&&this.width>maxWidth){
			showMessage('Width', 'px', this.width, maxWidth);
			result=false;
		}
		else if(isCheckImageHeight&&this.height>maxHeight){
			showMessage('Height', 'px', this.height, maxHeight);
			retult=false;
		}
		else if(isCheckImgSize&&this.fileSize>maxSize){
			showMessage('File Size', 'KB', this.filesize/1024, maxSize/1024);
			result=false;
		}
		else document.FileForm.submit();
	}
	
	function showMessage(type, unit, real, limit){
		var msg="Uploaded "+type+" is "+real+" "+unit+".\nThe limit is "+limit+" "+unit+".\nUpload Failed!";
		alert(msg);
	}
</script>
</head>
<body>
<div id="header">
	<h1>Upload Advertisement</h1>
	<div id="menu">
		<ul id="nav">
			<li><a href="main.php">Main Page</a></li>
			<li><a href="logout.php">Logout</a></li>
		</ul>
	</div>
</div>
<div id="content">
	<h3>Upload Advertisement</h3>
	<?php if(isset($_GET['aid'])) { $update_aid=$_GET['aid']; $_SESSION['update_aid']=$update_aid; } ?>
	<section>
	<form action="up_fin.php" method="POST" enctype="multipart/form-data" onsubmit="return checkFile()">
		<p>Start Time<br/><input type="date" name="start"/></p>
		<p>End Time<br/><input type="date" name="end"/></p>
		<p>Upload Image<br/><input type="file" name="file" id="file"/></p>
		<p>Advertisement Contents<br/><textarea rows=5 cols=20 name="ad_content"></textarea></p>
		<p><input type="submit" name="upload" value="Upload!"/></p>
	</form>
	</section>
</div>
</body>
</html>