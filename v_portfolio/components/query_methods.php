<?php
session_start();
if (isset($_SESSION['id'])){
	$uid = $_SESSION['id'];
}

include("vcinfo.inc");

//echo '{"orders":';

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT mid, nickname
							FROM payment_methods
						  	WHERE uid = " . $uid); 
    if(  $stmt->execute() ){

    $resultJSON = json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
		echo '{"methods":' . $resultJSON. '}';
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
