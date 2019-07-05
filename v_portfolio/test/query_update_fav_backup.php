<?php

session_start();
if (isset($_SESSION['id'])){
	$uid = $_SESSION['id'];
}

if (isset($_REQUEST['iid'])){
	$iid = $_REQUEST['iid'];
}

if (isset($_REQUEST['mvd'])){
	$mvd = $_REQUEST['mvd'];
}


include("vcinfo.inc");


try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT num_favs FROM inventory WHERE iid = :iid LIMIT 1"); 
		$stmt->bindParam(':iid', $iid);
		$stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

	
	$newNumFav = ($result["num_favs"] + 1);
	
	
	$stmt1 = $conn->prepare("UPDATE inventory SET num_favs = :newNumFav WHERE iid = :iid"); 
		$stmt1->bindParam(':newNumFav', $newNumFav);
		$stmt1->bindParam(':iid', $iid);
		
	if($stmt1->execute()){
		
		echo $newNumFav . "_" . $iid . "_" . $mvd;
		
	}
	
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;


?>
