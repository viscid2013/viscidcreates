<?php
session_start();
if (isset($_SESSION['id'])){
	$uid = $_SESSION['id'];
}

//fetch file location of current avatar

$servername = "localhost";
$username = "phpmyadmin";
$password = "2020DofSM!";
$dbname = "viscid";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT avatar_link
							FROM users
							WHERE uid = :uid
							"); 
    $stmt->bindParam(':uid', $uid);
	$stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
	$currentAvatar = $result['avatar_link'];
	
	echo $currentAvatar;
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}


//end fetch current avatar location

//remove current avatar file if not null

if( $currentAvatar !== 'null' || $currentAvatar !== null ){
	unlink($currentAvatar);
}

$target_dir = "../uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
	
      //$extension = explode("/", $_FILES["fileToUpload"]["type"]);
      //$name = "acctName.".$extension[1];
     
    //move_uploaded_file($tmp, "upload/" . $user.".".$extension[1]);
	
	echo "<p>".$target_file."</p>";
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
		
	//update users table with new avatar link
		
	try {

    	$sql_avatar = "UPDATE users SET avatar_link = '" . $target_file . "' WHERE uid = ". $uid . "";
		$conn->exec($sql_avatar);

		echo "<script>window.location = '../pages/vc_account.php?accordion=profile'</script>";
		
		}//end try
	catch(PDOException $e) {
    	echo "Error: " . $e->getMessage();
		}
		$conn = null;
		
    } //end if move uploaded file
	else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>