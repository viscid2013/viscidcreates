<?php

/*
{"inventory":[
  { "id":"", "title":"", "image":"" },
  { "id":"", "title":"", "image":"" },
  { "id":"", "title":"", "image":"" }
]}
*/

echo '{"inventory":[';

$servername = "localhost";
$username = "phpmyadmin";
$password = "2020DofSM!";
$dbname = "viscid";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT iid, title, image_link FROM inventory"); 
    $stmt->execute();

    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
    foreach($stmt->fetchAll() as $k=>$v) { 
        foreach($v as $kk=>$vv) {
			echo $vv. "<br />";
    }
	}
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
echo ']}';

?>