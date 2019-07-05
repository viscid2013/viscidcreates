<?php

if(isset( $_REQUEST['search'] )){
	$search = "%" . $_REQUEST['search'] . "%";
}
else{
	$search = "";
}

if(isset( $_REQUEST['filters'] )){
	$filters = $_REQUEST['filters'];
	echo $filters . "<br />";
	$filters = explode("_", $filters);
	print_r($filters) . "<br />";
	$fcount = count($filters);
	echo $fcount . "<br />";
}

include("vcinfo.inc");

//echo '{"inventory":';

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	if(isset( $_REQUEST['search'] ) ){
		$stmt = $conn->prepare("SELECT iid, title, image_link, num_favs, formats FROM inventory WHERE (title LIKE :search) OR (tags LIKE :search)"); 
		$stmt->bindParam(':search', $search);
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$count  = $stmt->rowCount();
		$stmt->execute();
	}
	elseif(!isset( $_REQUEST['search'] ) && isset( $_REQUEST['filters'] ) ){
		if( $fcount === 1 ){
			$stmt = $conn->prepare("SELECT iid, title, image_link, num_favs, formats FROM inventory WHERE (formats LIKE :filter0)"); 
			$stmt->bindParam(':filter0', $filters[0]);
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$count  = $stmt->rowCount();
			$stmt->execute();
		}
		elseif( $fcount === 2 ){
			$stmt = $conn->prepare("SELECT iid, title, image_link, num_favs, formats FROM inventory WHERE (formats LIKE :filter0) XOR (formats LIKE :filter1)"); 
			$stmt->bindParam(':filter0', $filters[0]);
			$stmt->bindParam(':filter1', $filters[1]);
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$count  = $stmt->rowCount();
			$stmt->execute();
		}
		elseif( $fcount === 3 ){
			$stmt = $conn->prepare("SELECT iid, title, image_link, num_favs, formats FROM inventory WHERE (formats LIKE :filter0) XOR (formats LIKE :filter1) XOR (formats LIKE :filter2)"); 
			$filt0 = "%" . $filters[0] . "%";
			$filt1 = "%" . $filters[1] . "%";
			$filt2 = "%" . $filters[2] . "%";
			$stmt->bindParam(':filter0', $filt0);
			$stmt->bindParam(':filter1', $filt1);
			$stmt->bindParam(':filter2', $filt2);
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$count  = $stmt->rowCount();
			$stmt->execute();
		}
	
	}
	
		elseif(isset( $_REQUEST['search'] ) && isset( $_REQUEST['filters'] ) ){
		if( $fcount === 1 ){
			$stmt = $conn->prepare("SELECT iid, title, image_link, num_favs, formats FROM inventory WHERE (title LIKE :search) OR (tags LIKE :search) AND (formats LIKE :filter0)"); 
			$stmt->bindParam(':search', $search);
			$stmt->bindParam(':filter0', $filters[0]);
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$count  = $stmt->rowCount();
			$stmt->execute();
		}
		elseif( $fcount === 2 ){
			$stmt = $conn->prepare("SELECT iid, title, image_link, num_favs, formats FROM inventory WHERE (title LIKE :search) OR (tags LIKE :search) AND (formats LIKE :filter0) XOR (formats LIKE :filter1)"); 
			$stmt->bindParam(':search', $search);
			$stmt->bindParam(':filter0', $filters[0]);
			$stmt->bindParam(':filter1', $filters[1]);
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$count  = $stmt->rowCount();
			$stmt->execute();
		}
		elseif( $fcount === 3 ){
			
			$stmt = $conn->prepare("SELECT iid, title, image_link, num_favs, formats FROM inventory WHERE (title LIKE :search) OR (tags LIKE :search) AND (formats LIKE :filter0) XOR (formats LIKE :filter1) XOR (formats LIKE :filter2)"); 
			$stmt->bindParam(':search', $search);
			$filt0 = "%" . $filters[0] . "%";
			$filt1 = "%" . $filters[1] . "%";
			$filt2 = "%" . $filters[2] . "%";
			$stmt->bindParam(':filter0', $filt0);
			$stmt->bindParam(':filter1', $filt1);
			$stmt->bindParam(':filter2', $filt2);
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$count  = $stmt->rowCount();
			$stmt->execute();
		}
		


	}
	
	else{
		$stmt = $conn->prepare("SELECT iid, title, image_link, num_favs FROM inventory");	
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$count  = $stmt->rowCount();
		$stmt->execute();
	}

	
	if( $count < 1 ){
		echo "No results.";
	}
	else{
		for( $i = 0; $i < $count; $i++ ){
		?>
		
		<!-- image tiles -->
  <div class="vcImageTile w3-third w3-card w3-display-container w3-hover-theme">
	  
	<div class="vcImageTileBar w3-theme-l3 w3-cell-row w3-opacity">
		<div class="w3-container w3-cell"><span class="vcicon icon-favoritesvc"></span>&nbsp;<?php echo $result[$i]['num_favs']; ?></div>
		  <div class="w3-container w3-cell"><span class="vcicon icon-commentsvc"></span>&nbsp;<?php echo $result[$i]['num_favs']; ?></div>
		  <div class="w3-container w3-cell"><span class="vcicon icon-sharevc"></span></div>
    </div><!-- end image tileBar -->
	  
		<div class="vcImage"> 
			<span class="imgOpen" id="img_<?php echo $result[$i]['iid']; ?>" onClick="imgOpen(this.id)"><img src="../images/<?php echo $result[$i]['image_link']; ?>" alt="<?php echo $result[$i]['title']; ?>"  style="width:100%" /></span>
		</div> 
	  <div class="vcImageTileName w3-display-topleft w3-theme-light w3-opacity-min w3-hide" style="width: 100%;">
      <div class=""><?php echo $result[$i]['title']; ?></div>
    </div>
	  
	  			<!-- begin mobile order bar -->
			<div class="w3-container w3-theme-l3 w3-hide-large w3-hide-medium orderBarMob" style="width: 100%; position: relative; font-size:100%;">  
			<div class="w3-container w3-padding" style="width: 100%">
			  <select id="mSize_<?php echo $result[$i]['iid']; ?>" class="w3-select w3-border" name="option">
				  <option value="" disabled selected>Choose a size</option>
				  <option value="0">4X6</option>
				  <option value="1">5X7</option>
				  <option value="2">11X17</option>
				</select>
			</div>
			<div class="w3-container w3-padding" style="width: 100%">
				<div id="<?php echo $result[$i]['iid']; ?>" class="w3-button w3-block w3-theme-action" onclick="addToCart(this.id, 'mobile')">Add to Cart</div>
			</div>
				<div id="mAddToCartMsg_<?php echo $result[$i]['iid']; ?>" class="w3-block w3-theme w3-padding mAddCartMsgs"></div>
			</div>
			<!-- end mobile order bar -->

  </div> <!-- end image tiles -->

		<?php
		}//end for
	}//end else
	
	
}//end try
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;

//echo '}';

?>