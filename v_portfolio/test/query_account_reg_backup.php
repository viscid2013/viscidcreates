<?php

if (isset($_REQUEST['vcEmail'])){
	$vcEmail = $_REQUEST['vcEmail'];
}
if (isset($_REQUEST['vcPass'])){
	$vcPass = $_REQUEST['vcPass'];
	$vcPass = password_hash($vcPass, PASSWORD_ARGON2I);
}
if (isset($_REQUEST['vcFirst'])){
	$vcFirst = $_REQUEST['vcFirst'];
}
if (isset($_REQUEST['vcLast'])){
	$vcLast = $_REQUEST['vcLast'];
}
$date_created = mktime();
$date_created = date("Y-m-d H:i:s",$date_created);
/*else{
	$vcEmail = "";
}*/


$servername = "localhost";
$username = "phpmyadmin";
$password = "2020DofSM!";
$dbname = "viscid";

//echo '{"order":';

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO users (email, first, last, date_created)
    VALUES ('" . $vcEmail . "', '" . $vcFirst . "', '" . $vcLast . "','" . $date_created . "')";
    // use exec() because no results are returned
	if( $conn->exec($sql) ){
		$sql2 = "INSERT INTO access (uid, date_created)
		SELECT uid, date_created FROM users 
		WHERE (email = '" . $vcEmail . "') AND (last = '" . $vcLast . "')";
		
		if( $conn->exec($sql2) ){
			
			$stmt = $conn->prepare( 'SELECT uid FROM users WHERE email = :email' );
			$stmt->bindParam(':email',$vcEmail);
			$stmt->execute();
			$uid = $stmt->fetch(PDO::FETCH_ASSOC);
			$uid = $uid['uid'];

			$sql3 = "UPDATE access SET upass = '" . $vcPass . "' WHERE uid = ". $uid . "";
			$conn->exec($sql3);
		}
		
	}
    echo "New record created successfully";
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;
/*INSERT INTO access (uid, date_created)
SELECT uid, date_created FROM users
WHERE email='' AND last = '';*/

?>
