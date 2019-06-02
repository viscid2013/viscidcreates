<?php
session_start();
if (isset($_SESSION['id'])){
	$uid = $_SESSION['id'];
}
if (isset($_REQUEST['mid'])){
	$mid = $_REQUEST['mid'];
}
else{
	$mid = "";
}

include("vcinfo.inc");


try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT *
							FROM payment_methods
							WHERE mid = :mid AND uid = :uid
							"); 
    $stmt->bindParam(':mid', $mid);
	$stmt->bindParam(':uid', $uid);
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
