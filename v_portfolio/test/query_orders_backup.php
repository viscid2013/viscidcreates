<?php

/*
{"inventory":[
  { "id":"", "title":"", "image":"" },
  { "id":"", "title":"", "image":"" },
  { "id":"", "title":"", "image":"" }
]}

$resultJSON = json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));

*/

$servername = "localhost";
$username = "phpmyadmin";
$password = "2020DofSM!";
$dbname = "viscid";

echo '{"orders":';

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT oid, uid, iid, fid, qid, status, date_created, format_chosen, tracking_no, pay_method, price, tax FROM orders"); 
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