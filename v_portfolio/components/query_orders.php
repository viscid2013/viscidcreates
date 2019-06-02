<?php
session_start();
if (isset($_SESSION['id'])){
	$uid = $_SESSION['id'];
}

$servername = "localhost";
$username = "phpmyadmin";
$password = "2020DofSM!";
$dbname = "viscid";

//echo '{"orders":';

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT orders.oid, inventory.title, inventory.iid, orders.date_created
							FROM orders
							INNER JOIN inventory ON orders.iid=inventory.iid
						  	WHERE orders.uid = " . $uid); 
    $stmt->execute();

	$stmt2 = $conn->prepare("SELECT count(*) FROM orders WHERE uid = ?");
	$stmt2->execute([$uid]);
	$count = $stmt2->fetchColumn();

	if( $count < 1 ){
		//$zeroArray = array("title", "oid", "date_created");
			//$zeroArray2 = array( $zeroArray[0]=>"What?", $zeroArray[1]=>"No orders yet?", $zeroArray[2]=>"Better get to ordering!" );
		//$resultJSON = json_encode( $zeroArray2 );
		//echo '{"orders":[' . $resultJSON. ']}';
		$resultJSON = '';
		echo $resultJSON;
	}
	else{
    $resultJSON = json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
		echo '{"orders":' . $resultJSON. '}';
	}
	
	
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;

//echo '}';

/*SELECT orders.oid, inventory.title, inventory.iid, orders.date_created
FROM orders
INNER JOIN inventory ON orders.iid=inventory.iid;

SELECT oid, uid, iid, fid, qid, status, date_created, format_chosen, tracking_no, pay_method, price, tax FROM orders*/

?>
