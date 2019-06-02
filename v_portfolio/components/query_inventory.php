<?php

/*
{"inventory":[
  { "id":"", "title":"", "image":"" },
  { "id":"", "title":"", "image":"" },
  { "id":"", "title":"", "image":"" }
]}

$resultJSON = json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));

*/

include("vcinfo.inc");

echo '{"inventory":';

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT iid, title, image_link, num_favs FROM inventory"); 
    $stmt->execute();

    $resultJSON = json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
	
	echo $resultJSON;
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;

echo '}';

?>