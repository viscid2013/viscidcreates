<?php

/*
{"inventory":[
  { "id":"", "title":"", "image":"" },
  { "id":"", "title":"", "image":"" },
  { "id":"", "title":"", "image":"" }
]}

$outp = "";
while($rs = $stmt->setFetchMode(PDO::FETCH_ASSOC)) {
  if ($outp != "") {$outp .= ",";}
  $outp .= '{"id":"'  . $rs["iid"] . '",';
  $outp .= '"title":"'   . $rs["title"]        . '",';
  $outp .= '"image":"'. $rs["image"]     . '"}';
}
$outp ='{"records":['.$outp.']}';

###

$result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
    foreach($stmt->fetchAll()

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
	$outp = "";
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
	while($rs = $stmt->fetchAll()) {
  		if ($outp != "") {$outp .= ",";}
  		$outp .= '{"id":"'  . $rs["iid"] . '",';
  		$outp .= '"title":"'   . $rs["title"]        . '",';
  		$outp .= '"image":"'. $rs["image"]     . '"}';
	}
	$outp ='{"inventory":['.$outp.']}';
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
echo ']}';

?>