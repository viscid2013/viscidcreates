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



echo "<div id='cartStep1'><label class='w3-margin-bottom vcBold'>Items:&nbsp;</label>";

if($id_count < 1){
	
	echo "<div class='w3-card w3-padding w3-margin-bottom'>Your cart is empty!</div>";
}

else{

$sub_totals = [];

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	foreach( $id_sizes as $key=>$val ){
		
		//$cart[$key] = explode( "_", $val );
			$sizeCount[$key] = count($val);
		
			$stmt[$key] = $conn->prepare("SELECT title, image_link FROM inventory WHERE iid = :iid"); 
			$stmt[$key]->bindParam(':iid',$key);
			$stmt[$key]->execute();

			$result[$key] = $stmt[$key]->fetch(PDO::FETCH_ASSOC);
			
			$cartArray[$key] = [];
		
		foreach( $val as $k=>$v ){
			$stmt2[$key][$k] = $conn->prepare("SELECT size, name, price FROM available_formats WHERE fid = :fid");
			$stmt2[$key][$k]->bindParam(':fid',$v);
			$stmt2[$key][$k]->execute();

			$result2[$key] = $stmt2[$key][$k]->fetch(PDO::FETCH_ASSOC);
			$cartArray[$key][$k] = $result2[$key];
			
		}

		echo "<div class='w3-container w3-border w3-margin-bottom w3-card w3-center w3-padding'>
			<span onclick='loadPage(\"../components/remove_cart_item.php?removeIt=" . $key . "\", removeItem)' class='w3-block w3-theme-l3' style='font-size: 120%; margin-bottom: 3px'>&times;</span>
			<div class='cartImgFrame' style='margin: 0 auto'>
			<img id='cartImg_" . $key . "' src='../images/" . $result[$key]['image_link'] . "' alt='cart thumbnail image' style='width: 100px;' /></div>";
				echo "<div>
						<span  class='vcBold'>" . $result[$key]['title'] . "</span>";
			$sub_price = [];
			foreach( $cartArray[$key] as $kk=>$vv ){
				echo "<div><span class='vcItalic'>" . $vv['size'] . "</span>&nbsp;|&nbsp;$" . number_format($vv['price'], 2) . "</div>";
				array_push($sub_price, $vv['price']);
			}	
				$sub_total = array_sum($sub_price);
			 array_push($sub_totals, $sub_total);
			echo "<div>$" . number_format(array_sum($sub_price), 2) . "</div>";
		echo "</div>
		</div>";
		
		
	}//end foreach key->val
	
	$total = number_format(array_sum($sub_totals), 2);
	$taxes = ($total * 0.07);
	$grand_total = $total + $taxes;
	
	//get address if user
	if( isset( $_SESSION['id']) && $_SESSION['user'] !== "guest" ){
		
			$stmtA = $conn->prepare("SELECT * FROM users WHERE uid = :uid"); 
			$stmtA->bindParam(':uid',$_SESSION['id']);
			$stmtA->execute();

			$resultA = $stmtA->fetch(PDO::FETCH_ASSOC);
			
			$firstName = $resultA["first"];
			$lastName = $resultA["last"];
			$fullAddress = $resultA["address1"] . "\r\n";
				if( $resultA["address2"] != '' ){
					$fullAddress .= $resultA["address2"] . "\r\n";
				}
			
			$fullAddress .= $resultA["city"] . ",&nbsp;";
			$fullAddress .= $resultA["state"] . "&nbsp;" . $resultA["zip"];
		
	}
	
	else{
		$firstName = '';
		$lastName = '';
		$fullAddress = '';
	}
	
	echo '<div>
	<label class="vcBold">Shipping Method: </label>
		<div>
			<select class="w3-select w3-border" name="ship" id="ship">
				<option value="ship1">Standard: 5-7 days</option>
				<option value="ship2">Expedited: 2-3 days</option>
				<option value="ship3">Lightspeed: 2 days ago</option>
			</select>
		</div>';
	
	echo '<label class="vcBold">First Name</label><input type="text" class="w3-input w3-border" value="' . $firstName . '" />';
	
	echo '<label class="vcBold">Last Name</label><input type="text" class="w3-input w3-border" value="' . $lastName. '" />';
	
	echo '<label class="vcBold">Shipping Address: </label>
		<div>
			<textarea class="w3-input w3-border" name="shipAddress">' . $fullAddress . '</textarea>
		</div>
		<div class="w3-row">
			<div class="w3-half vcBold">Taxes &amp; Fees:</div>
			<div class="w3-half">$' . $taxes . '</div>
		</div>
		<div class="w3-row w3-margin-bottom">
			<div class="w3-half vcBold">Total:</div>
			<div class="w3-half">$' . $grand_total . '</div>
		</div>
</div>';

?>

<div class="w3-bar" id="cartButtons1">
			<div id="closeCart" class="vc_button_form vc_boxshadow w3-button w3-theme-alertPink" style="margin-right: 4px" onclick="document.getElementById('cart_modal').style.display='none'">Close Cart</div>
				<div class="vc_button_form w3-button vc_boxshadow w3-theme-l3" style="margin-left: 4px" onClick="paymentContent('pay')">Payment</div>
		</div>

<?php

echo '</div><!-- end cart step 1 -->';
	

	
echo "<div id='cartStep2' class='w3-padding-24' style='display: none'>
		<h3>PAYMENT</h3>
			<div>You have reached the boundaries of this test site's Order functionality. Thanks for visiting!</div>";
		?>	
			<div class="w3-bar" id="cartButtons2">
			<div id="closeCart" class="vc_button_form vc_boxshadow w3-button w3-theme-alertPink" style="margin-right: 4px" onclick="document.getElementById('cart_modal').style.display='none'">Close Cart</div>
				<div class="vc_button_form w3-button vc_boxshadow w3-theme-l3" style="margin-left: 4px" onClick="paymentContent('nopay')">Cancel</div>
		<?php		
				
		echo '</div></div>';	

	
	//echo $resultJSON;
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;

}//end if cart else

?>