<?php

include("vcinfo.inc");

//<img class="vcSlides" src="img_snowtops.jpg" style="width:100%">

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT inventory.iid, inventory.title, inventory.image_link, inventory.num_favs 
							FROM inventory
							INNER JOIN comments ON inventory.iid=comments.iid
							"); 
    $stmt->execute();

	
	/* SELECT orders.oid, inventory.title, inventory.iid, orders.price, orders.tax, orders.date_created, orders.tracking_no, orders.status, orders.pay_method 
							FROM orders
							INNER JOIN inventory ON orders.iid=inventory.iid
							WHERE orders.oid = :oid */
	
    $array = $stmt->fetchAll(PDO::FETCH_ASSOC);
	
	$count = $conn->query("SELECT count(*) FROM inventory")->fetchColumn();
	

		for( $ii = 0; $ii < count($array); $ii++ ){
			//echo $key . ": " . $value. "<br />";
			$img[$ii] = $array[$ii]['image_link'];
			$title[$ii] = $array[$ii]["title"];
			$favs[$ii] = $array[$ii]["num_favs"];
			$iid[$ii] = $array[$ii]["iid"];
			$cCount[$ii] = $array[$ii]["comment"];
			
			echo '<div class="w3-cell vcSlides" style="font-size:130%; height: 100%">
			<div id="enterCommentS" style="display: none"></div>
			<div id="showCommentS" style="display: none"></div>
			<div class="w3-theme-l3 w3-padding w3-center w3-cell-row slidesBar" style="width: 100%; position: relative; z-index:1;">
				<div class="w3-cell" onClick="loadPage(\'../components/query_update_fav.php?iid=' . $iid[$ii] . '\', addFav)" style="cursor: pointer"><span class="vcicon icon-favoritesvc"></span>&nbsp;<span id="favs_' . $iid[$ii] . '">' . $favs[$ii] . '</span></div>
				<div class="w3-cell" onClick="fetchComments(\'load\')"><span class="vcicon icon-commentsvc"></span>&nbsp;' . $cCount[$ii] . '</div>
				<div class="w3-cell"><span class="vcicon icon-sharevc"></span></div>
			  </div>
				<input id="slide_' . $iid[$ii] . '" value="' . ($ii +1) . '" style="display: none;">
			  <img id="slideImg_' . ($ii +1) . '" class="vcSlidesImg" src="../images/' . $img[$ii] . '" style="width:100%">
	
			<div class="w3-cell-row w3-theme-l3 w3-hide-small orderBar" style="width: 100%; position: relative; z-index:1; font-size:90%;">  
			<div class="w3-cell w3-padding" style="width: 75%">
			  <select id="size_' . $iid[$ii] . '" class="w3-select w3-border" name="option">
				  <option value="" disabled selected>Choose a size</option>
				  <option value="0">4X6</option>
				  <option value="1">5X7</option>
				  <option value="2">11X17</option>
				</select>
			</div>
			<div class="w3-cell w3-padding" style="width: 25%">
				<div class="w3-button w3-block w3-theme-action" onclick="addToCart(' . $iid[$ii] . ',\'desk\')">Add to Cart</div>
			</div>
			</div>	
			<div id="addToCartMsg_' . $iid[$ii] . '" class="w3-block w3-theme w3-padding addCartMsgs"></div>
			</div>';
			

			//echo '<img id="' . ($ii +1) . '" class="vcSlides" src="../images/' . $img[$ii] . '" style="width:100%">';
		}

	

}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;



?>