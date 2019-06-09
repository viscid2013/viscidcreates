<?php

session_start();
if (isset($_SESSION['id'])){
	$uid = $_SESSION['id'];
}
if (isset($_SESSION['id_sizes'])){
	$id_sizes = $_SESSION['id_sizes'];
}


include("vcinfo.inc");

//$id_sizes = json_decode($id_sizes);
$id_count = count($id_sizes);
$cart = [];

echo "<label class='w3-margin-bottom vcBold'>Items:&nbsp;</label>";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	foreach( $id_sizes as $key=>$val ){
		
		$cart[$key] = explode( "_", $val );
		
			$stmt[$key] = $conn->prepare("SELECT title, image_link FROM inventory WHERE iid = :iid"); 
			$stmt[$key]->bindParam(':iid',$cart[$key][0]);
			$stmt[$key]->execute();

			$result[$key] = $stmt[$key]->fetch(PDO::FETCH_ASSOC);

			$stmt2[$key] = $conn->prepare("SELECT size, name, price FROM available_formats WHERE fid = :fid");
			$stmt2[$key]->bindParam(':fid',$cart[$key][1]);
			$stmt2[$key]->execute();

			$result2[$key] = $stmt2[$key]->fetch(PDO::FETCH_ASSOC);

			echo "<div class='w3-cell-row w3-border w3-margin-bottom'>
		<div class='w3-cell cartImgFrame'>
			<img id='cartImg_" . $key . "' src='../images/" . $result[$key]['image_link'] . "' alt='cart thumbnail image' style='width: 100px' /></div>
		<div class='w3-cell'>
			<div>" . $result[$key]['title'] . "&nbsp;|&nbsp;" . $result2[$key]['size'] . "</div>
		</div>
		</div>";
		
		
	}//end foreach key->val
	
	echo '<div>
	<label class="vcBold">Shipping Method: </label>
		<div>
			<select class="w3-select w3-border" name="ship" id="ship">
				<option value="ship1">Standard: 5-7 days</option>
				<option value="ship2">Expedited: 2-3 days</option>
				<option value="ship3">Lightspeed: 2 days ago</option>
			</select>
		</div>
		<label class="vcBold">Shipping Address: </label>
		<div>
			<textarea class="w3-input w3-border" name="shipAddress"></textarea>
		</div>
		<div class="w3-row">
			<div class="w3-half vcBold">Taxes &amp; Fees:</div>
			<div class="w3-half">$0.23</div>
		</div>
		<div class="w3-row w3-margin-bottom">
			<div class="w3-half vcBold">Total:</div>
			<div class="w3-half">$15.00</div>
		</div>
</div>';

	
	//echo $resultJSON;
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;



?>