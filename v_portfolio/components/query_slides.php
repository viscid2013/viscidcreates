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
			
			echo '<div class="vcSlides" style="font-size:130%;">
			<div class="w3-theme-l3 w3-padding w3-center w3-cell-row slidesBar" style="width: 100%; z-index:2;">
				<div class="w3-cell"><span class="vcicon icon-favoritesvc"></span>&nbsp;' . $favs[$ii] . '</div>
				<div class="w3-cell"><span class="vcicon icon-commentsvc"></span>&nbsp;' . $favs[$ii] . '</div>
				<div class="w3-cell"><span class="vcicon icon-sharevc"></span></div>
			  </div>
				<input id="slide_' . $iid[$ii] . '" value="' . ($ii +1) . '" style="display: none;">
			  <img id="slideImg_' . ($ii +1) . '" class="vcSlidesImg w3-border" src="../images/' . $img[$ii] . '" style="width:100%">
	
			<div class="w3-cell-row orderBar" style="width: 100%; z-index:2; font-size:90%;">  
			<div class="w3-cell w3-padding" style="width: 75%">
			  <select class="w3-select" name="option">
				  <option value="" disabled selected>Choose your option</option>
				  <option value="1">4X6</option>
				  <option value="2">5X7</option>
				  <option value="3">8X10</option>
				</select>
			</div>
			<div class="w3-cell w3-padding" style="width: 25%">
				<div class="w3-button w3-block w3-theme-action">Add to Cart</div>
			</div>
			</div>
			</div>';
			

			//echo '<img id="' . ($ii +1) . '" class="vcSlides" src="../images/' . $img[$ii] . '" style="width:100%">';
		}

	

}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;



?>