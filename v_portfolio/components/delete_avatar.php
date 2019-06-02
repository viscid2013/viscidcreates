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
//begin update user table 

    if ( unlink($currentAvatar) ) {
        echo "The file ". $currentAvatar. " has been removed from the filesystem.";
		
	//update users table with new avatar link
		
	try {

    	$sql_avatar = "UPDATE users SET avatar_link = 'NULL' WHERE uid = ". $uid . "";
		$conn->exec($sql_avatar);

		echo "<script>window.location = '../pages/vc_account.php?accordion=profile'</script>";
		
		}//end try
	catch(PDOException $e) {
    	echo "Error: " . $e->getMessage();
		}
		$conn = null;
		
    } //end if move uploaded file
	else {
        echo "Sorry, there was an error updating your profile.";
    }

?>