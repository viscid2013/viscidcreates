<?php

session_start();
if (isset($_SESSION['id'])){
	$uid = $_SESSION['id'];
}
if (isset($_SESSION['id_sizes'])){
	$id_sizes = $_SESSION['id_sizes'];
}
if (isset($_SESSION['cart_items'])){
	$items = $_SESSION['cart_items'];
}
/*$id_sizes = array("1"=>"2", "4"=>"1");

foreach($id_sizes as $k=>$v){
	echo $k . "--" . $v . "<br />";
}*/

include("vcinfo.inc");

$cartArray = [];

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	foreach( $id_sizes as $key=>$val ){
		$stmt[$key] = $conn->prepare("SELECT title, image_link FROM inventory WHERE iid = :iid"); 
		$stmt[$key]->bindParam(':iid',$key);
		$stmt[$key]->execute();

		$result[$key] = $stmt[$key]->fetch(PDO::FETCH_ASSOC);
		echo $result[$key]['title'] . " | <img id='cartImg_" . $key . "' src='../images/" . $result[$key]['image_link'] . "' alt='cart thumbnail image' style='width:20%' /><br />";
	}

	
	//echo $resultJSON;
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;



?>