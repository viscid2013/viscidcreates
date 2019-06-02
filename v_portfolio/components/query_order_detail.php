<?php

if (isset($_REQUEST['oid'])){
	$oid = $_REQUEST['oid'];
}
else{
	$oid = "";
}

/*
{"inventory":[
  { "id":"", "title":"", "image":"" },
  { "id":"", "title":"", "image":"" },
  { "id":"", "title":"", "image":"" }
]}

$resultJSON = json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));

*/

include("vcinfo.inc");

//echo '{"order":';

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT orders.oid, inventory.title, inventory.iid, orders.price, orders.tax, orders.date_created, orders.tracking_no, orders.status, orders.pay_method 
							FROM orders
							INNER JOIN inventory ON orders.iid=inventory.iid
							WHERE orders.oid = :oid
							"); 
    $stmt->bindParam(':oid', $oid);
	$stmt->execute();

    $resultJSON = json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
	
	$resultJSON = str_replace(array('[', ']'), '', $resultJSON );
	
	echo $resultJSON;
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;

//echo '}';

/*

SELECT orders.oid, inventory.title, inventory.iid, orders.date_created, orders.tracking_no, orders.status, orders.pay_method 
							FROM orders
							INNER JOIN inventory ON orders.iid=inventory.iid
							WHERE orders.oid = :oid

SELECT orders.oid, inventory.title, inventory.iid, orders.date_created
FROM orders
INNER JOIN inventory ON orders.iid=inventory.iid;

SELECT oid, uid, iid, fid, qid, status, date_created, format_chosen, tracking_no, pay_method, price, tax FROM orders*/

?>
