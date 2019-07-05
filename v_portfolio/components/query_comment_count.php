<?php

if (isset($_REQUEST['cid'])){
		$iid = $_REQUEST['cid'];
	}

include("vcinfo.inc");

//<img class="vcSlides" src="img_snowtops.jpg" style="width:100%">

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT count(*) FROM comments WHERE iid = :iid"); 
	$stmt->bindParam(':iid', $iid);
    $stmt->execute();
	
    $count = $stmt->fetchColumn();

	echo $count;

}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;



?>