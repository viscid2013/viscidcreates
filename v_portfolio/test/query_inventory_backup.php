<?php

if(isset( $_REQUEST['search'] )){
	$search = "%" . $_REQUEST['search'] . "%";
	echo $search . "<br />";
}
else{
	$search = "";
}

if(isset( $_REQUEST['filters'] )){
	$filters = $_REQUEST['filters'];
}

include("vcinfo.inc");

//echo '{"inventory":';

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	if(isset( $_REQUEST['search'] )){
		$stmt = $conn->prepare("SELECT iid, title, image_link, num_favs FROM inventory WHERE (title LIKE :search) OR (tags LIKE :search)"); 
		$stmt->bindParam(':search', $search);
	}
	else{
		$stmt = $conn->prepare("SELECT iid, title, image_link, num_favs FROM inventory");		
	}
    $stmt->execute();

    $resultJSON = json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
	
	if( $stmt->rowCount() < 1 ){
		echo "No results.";
	}
	else{
		echo '{"inventory":' . $resultJSON . '}';
	}
	
	
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;

//echo '}';

?>