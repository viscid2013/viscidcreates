<?php
session_start();
if (!isset($_SESSION['id'])){
	
	$faved = 0;
}
else{
	
include("vcinfo.inc");


try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	$stmt = $conn->prepare("SELECT * FROM faves WHERE (iid = :iid) AND (uid = :iid)"); 
			$stmt->bindParam(':iid', $iid);
			$stmt->bindParam(':uid', $uid);
			$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
	
	$faved = $stmt->rowCount();
		
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;

	}//end if uid

?>