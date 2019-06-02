<?php
session_start();
if (isset($_SESSION['id'])){
	$oid = $_SESSION['id'];
}

$servername = "localhost";
$username = "phpmyadmin";
$password = "2020DofSM!";
$dbname = "viscid";

//echo '{"order":';

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT first, last, email, avatar_link, bgPos, bgSize, date_of_birth, date_created
							FROM users
							WHERE uid = :uid
							"); 
    $stmt->bindParam(':uid', $oid);
	$stmt->execute();

    $resultJSON = json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
	
	$resultJSON = str_replace(array('[', ']'), '', $resultJSON );
	
	echo $resultJSON;
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;


?>
