<?php
session_start();
if (isset($_SESSION['id'])){
	$uid = $_SESSION['id'];
}
if(isset( $_REQUEST['search'] ) && $_REQUEST['search'] !== '' ){
	$search = "%" . $_REQUEST['search'] . "%";
	$isSearch = true;
}
else{
	$search = "";
	$isSearch = false;
}

if(isset( $_REQUEST['filters'] )  && $_REQUEST['filters'] !== '' ){
	$filters = $_REQUEST['filters'];
	$filters = explode("_", $filters);
	$fcount = count($filters);
	$isFilter = true;
}
else{
	$filters = "";
	$isFilter = false;
}

include("vcinfo.inc");

//echo '{"inventory":';

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	if( $isSearch === true && $isFilter === false ){
		$stmt = $conn->prepare("SELECT iid, title, image_link FROM inventory WHERE (title LIKE :search) OR (tags LIKE :search)"); 
		$stmt->bindParam(':search', $search);
		
	}
	else if( $isSearch === true && $isFilter === true ){
		
		if( $fcount === 1 ){
			$filt0 = "%" . $filters[0] . "%";
		$stmt = $conn->prepare("SELECT iid, title, image_link FROM inventory WHERE (title LIKE :search) AND (formats LIKE :filter)"); 
		$stmt->bindParam(':search', $search);
		$stmt->bindParam(':filter', $filt0);
		}
		elseif( $fcount === 2 ){
			$filt0 = "%" . $filters[0] . "%";
			$filt1 = "%" . $filters[1] . "%";
		$stmt = $conn->prepare("SELECT iid, title, image_link FROM inventory WHERE (title LIKE :search) AND (formats LIKE :filter) OR (formats LIKE :filter1)"); 
		$stmt->bindParam(':search', $search);
		$stmt->bindParam(':filter', $filt0);
		$stmt->bindParam(':filter1', $filt1);
		}
		elseif( $fcount === 3 ){
			$filt0 = "%" . $filters[0] . "%";
			$filt1 = "%" . $filters[1] . "%";
			$filt2 = "%" . $filters[2] . "%";
		$stmt = $conn->prepare("SELECT iid, title, image_link FROM inventory WHERE (title LIKE :search) AND (formats LIKE :filter) OR (formats LIKE :filter1) OR (formats LIKE :filter2)"); 
		$stmt->bindParam(':search', $search);
		$stmt->bindParam(':filter', $filt0);
		$stmt->bindParam(':filter1', $filt1);
		$stmt->bindParam(':filter2', $filt2);
		}
			
	}
	else if( $isSearch === false && $isFilter === true ){
		
		if( $fcount === 1 ){
			$filt0 = "%" . $filters[0] . "%";
		$stmt = $conn->prepare("SELECT iid, title, image_link FROM inventory WHERE formats LIKE :filter"); 
		$stmt->bindParam(':filter', $filt0);
		}
		elseif( $fcount === 2 ){
			$filt0 = "%" . $filters[0] . "%";
			$filt1 = "%" . $filters[1] . "%";
		$stmt = $conn->prepare("SELECT iid, title, image_link FROM inventory WHERE (formats LIKE :filter) OR (formats LIKE :filter1)"); 
		$stmt->bindParam(':filter', $filt0);
		$stmt->bindParam(':filter1', $filt1);
		}
		elseif( $fcount === 3 ){
			$filt0 = "%" . $filters[0] . "%";
			$filt1 = "%" . $filters[1] . "%";
			$filt2 = "%" . $filters[2] . "%";
		$stmt = $conn->prepare("SELECT iid, title, image_link FROM inventory WHERE (formats LIKE :filter) OR (formats LIKE :filter1) OR (formats LIKE :filter2)"); 
		$stmt->bindParam(':filter', $filt0);
		$stmt->bindParam(':filter1', $filt1);
		$stmt->bindParam(':filter2', $filt2);
		}
			
	}
	else{
		$stmt = $conn->prepare("SELECT iid, title, image_link FROM inventory");		
	}
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	$count  = $stmt->rowCount();
	

	
	echo "COUNT: " . $count . "<br />";
	if( $count < 1 ){
		echo "No results.";
	}
	else{
		for( $i = 0; $i < $count; $i++ ){
			
			//comments and comment count
	
		$stmtB[$i] = $conn->prepare("SELECT * FROM comments WHERE iid = :iid"); 
			$stmtB[$i]->bindParam(':iid', $result[$i]['iid']);
    		$stmtB[$i]->execute();
	
    		$resC[$i] = $stmtB[$i]->fetchAll(PDO::FETCH_ASSOC);
			
			$cCount[$i] = $stmtB[$i]->rowCount();
			
		$stmtF[$i] = $conn->prepare("SELECT * FROM faves WHERE iid = :iid"); 
			$stmtF[$i]->bindParam(':iid', $result[$i]['iid']);
    		$stmtF[$i]->execute();
	
    		$resF[$i] = $stmtF[$i]->fetchAll(PDO::FETCH_ASSOC);
			
			$fCount[$i] = $stmtF[$i]->rowCount();
			
			echo "<script>alert('UID-Inv: ' + " . $resF[$i]["uid"] . ")</script>";
			
			if( $resF[$i]["uid"] === $uid ){
				$faved = 1;
			}
			else{
				$faved = 0;
			}
			
			
		?>

		<!-- image tiles -->
  <div id="vcImageTile_<?php echo $result[$i]['iid']; ?>" class="vcImageTile w3-third w3-card w3-display-container w3-hover-theme">
	  
	<div class="vcImageTileBar w3-theme-l3 w3-cell-row" style="position: relative;">
		<div class="w3-border w3-white w3-card viewComments" id="viewCommentsM_<?php echo $result[$i]['iid']; ?>"></div>
		
		<div id="behindSlidesM_<?php echo $result[$i]['iid']; ?>" class="w3-theme-l3 w3-opacity behindSlides" style="display: none; z-index: 2;"></div>
		<div class="w3-container w3-cell" style="cursor: pointer;" onClick="loadPage('../components/query_update_fav.php?iid=<?php echo $result[$i]['iid']; ?>', addFav)">
		<?php if( $faved === 0 ){	?>
			<span class="vcicon icon-favoritesvc"></span>&nbsp;<span id="mFavs_<?php echo $result[$i]['iid']; ?>"><?php echo $fCount[$i]; ?></span>
		<?php } 
			else if( $faved > 0 ){	?>
			<span class="vcicon icon-faves_addedvc"><span class="path1"></span><span class="path2"></span></span>&nbsp;<span id="mFavs_<?php echo $result[$i]['iid']; ?>"><?php echo $fCount[$i]; ?></span>
		<?php } ?>
		</div>
		  <div class="w3-container w3-cell" onClick="fetchComments('m','<?php echo $result[$i]['iid']; ?>')" style="cursor: pointer"><span class="vcicon icon-commentsvc"></span>&nbsp;<span id="cNum_<?php echo $result[$i]['iid']; ?>"><?php echo $cCount[$i]; ?></span></div>
		  <div id="shareButt_<?php echo $result[$i]['iid']; ?>" class="w3-container w3-cell" onClick="openShare('m', this.id, '<?php echo $result[$i]['iid']; ?>', 'tumb')"><span class="vcicon icon-sharevc"></span></div>
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