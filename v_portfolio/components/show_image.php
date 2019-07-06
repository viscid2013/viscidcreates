<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
	
<?php

if (isset($_REQUEST['iid'])){
	$iid = $_REQUEST['iid'];
}
else{
	$iid = "";
}


include("vcinfo.inc");


try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT * from inventory WHERE iid = :iid"); 
    $stmt->bindParam(':iid', $iid);
	$stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
	
		
		echo "<img src='../images/" . $result["image_link"] . "' alt='" . $result["title"] . "' title='" . $result["title"] . "' />";

}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;	
	
?>
	
	
</body>
</html>