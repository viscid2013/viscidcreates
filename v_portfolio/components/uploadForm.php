<!doctype html>
<html>
<head>
<meta charset="utf-8">
	
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="../styles/vstyle_W3.css">
	
<title>File Upload</title>
</head>

<body>
	
<form action="../components/upload.php" method="post" enctype="multipart/form-data">
    <!--Select image to upload:-->
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input class="w3-theme-action w3-button" type="submit" value="Upload" name="submit">
</form>
	

	
</body>
</html>