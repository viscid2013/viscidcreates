<?php

include("vcinfo.inc");

//<img class="vcSlides" src="img_snowtops.jpg" style="width:100%">

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT iid, title, image_link, num_favs FROM inventory"); 
    $stmt->execute();
	
    $array = $stmt->fetchAll(PDO::FETCH_ASSOC);
	
	$count = $conn->query("SELECT count(*) FROM inventory")->fetchColumn();
	
	
		for( $ii = 0; $ii < count($array); $ii++ ){
			//echo $key . ": " . $value. "<br />";
			$img[$ii] = $array[$ii]['image_link'];
			$title[$ii] = $array[$ii]["title"];
			$favs[$ii] = $array[$ii]["num_favs"];
			$iid[$ii] = $array[$ii]["iid"];
			
			//COMMENTS PER SLIDE
			$stmt2[$ii] = $conn->prepare("SELECT * FROM comments WHERE iid = :iid"); 
			$stmt2[$ii]->bindParam(':iid', $iid[$ii]);
    		$stmt2[$ii]->execute();
	
    		$arrayC[$ii] = $stmt2[$ii]->fetchAll(PDO::FETCH_ASSOC);
			
			$countC[$ii] = $stmt2[$ii]->rowCount();
			
				
			echo '<div class="w3-cell vcSlides" id="slideDiv_' . $iid[$ii] . '" style="font-size:130%; height: 100%; position: relative;">
			<div class="viewComments" id="viewCommentsS_' . $iid[$ii] . '" style="display: none"></div>
			<div id="behindSlides_' . $iid[$ii] . '" class="w3-white w3-opacity behindSlides" style="display: none; z-index: 2"></div>
			<div class="w3-theme-l3 w3-padding w3-center w3-cell-row slidesBar" style="width: 100%; position: relative; z-index:1;">
				<div class="w3-cell" onClick="loadPage(\'../components/query_update_fav.php?iid=' . $iid[$ii] . '\', addFav)" style="cursor: pointer"><span class="vcicon icon-favoritesvc"></span>&nbsp;<span id="favs_' . $iid[$ii] . '">' . $favs[$ii] . '</span></div>
				<div class="w3-cell" onClick="fetchComments(\'s\',\'' . $iid[$ii] . '\')"><span class="vcicon icon-commentsvc"></span>&nbsp;<span id="cNumS_' . $iid[$ii] . '">' . $countC[$ii] . '</span></div>
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