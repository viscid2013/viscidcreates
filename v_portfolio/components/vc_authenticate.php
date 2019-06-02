<?php

session_start();

$servername = "localhost";
$username = "phpmyadmin";
$password = "2020DofSM!";
$dbname = "viscid";


try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	// Check if the data from the login form was submitted, isset() will check if the data exists.
	if ( !isset($_POST['vcemail'], $_POST['vcpass']) ) {
		// Could not get the data that should have been sent.
	die ('Please provide username and password.');
	}
	//get uid to match from users
	$stmt1 = $conn->prepare( 'SELECT uid FROM users WHERE email = :email' );
			$stmt1->bindParam(':email',$_POST['vcemail']);
	
	if(	$stmt1->execute() ){
			$uid = $stmt1->fetch(PDO::FETCH_ASSOC);
			$uid = $uid['uid'];
			
	
	//select by uid from access
    $stmt = $conn->prepare("SELECT uid, upass FROM access WHERE uid = ". $uid ." LIMIT 1"); 
	//$stmt->bindParam(':uid', $uid, PDO::PARAM_INT);
		
	$stmt->execute();
	// Store the result so we can check if the account exists in the database.
	
		
	} //end if stmt1
	
	if ($stmt->rowCount() > 0) {
	//$stmt->bind_result($id, $password);
	//$stmt->fetch();
		
	$result = $stmt->fetch(PDO::FETCH_ASSOC);
		$id = $result['uid'];
		$password = $result['upass'];
		echo $id . "<br />";
		echo $password;
		
	// Account exists, now we verify the password.
	// Note: remember to use password_hash in your registration file to store the hashed passwords.
	if (password_verify($_POST['vcpass'], $password)) {
		// Verification success! User has loggedin!
		// Create sessions so we know the user is logged in, they basically act like cookies but remember the data on the server.
		session_regenerate_id();
		$_SESSION['loggedin'] = TRUE;
		$_SESSION['id'] = $id;
		echo "<script>window.location = '../pages/vc_account.php'</script>";
	} else {
		echo 'Incorrect password!';
	}
} else {
	echo 'Incorrect username!';
}
	
	
}
catch(PDOException $e) {
    echo "Error: UID: ". $uid . " | " . $e->getMessage();
}
$conn = null;


?>
