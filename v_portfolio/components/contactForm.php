<?php

if( isset( $_REQUEST['uid'] ) ){
	$uid = $_REQUEST['uid'];
}

?>

<form name="contact_form" id="contact_form">
			<?php if ( !isset( $_SESSION['id'] ) ) { 
						
				?>
				<label>Email Address:</label>
			<input type="text" class="w3-input w3-margin-top contact" id="email_contact" name="email_contact" value="" />
				<div id="cv_email" class="contactV w3-padding w3-text-theme-required" style="display: none"></div>
				<label>Name:</label>
			<input type="text" class="w3-input w3-margin-top contact" id="name_contact" name="name_contact" value="" />
				<div id="cv_name" class="contactV w3-padding w3-text-theme-required" style="display: none"></div>
				  	<?php }

					  else{
		
							include("vcinfo.inc");

							//echo '{"order":';

							try {
								$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
								$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
								$stmt = $conn->prepare("SELECT first, last, email, address1, address2, city, state, zip, avatar_link, bgPos, bgSize, date_of_birth, date_created
														FROM users
														WHERE uid = :uid
														"); 
								$stmt->bindParam(':uid', $uid);
								$stmt->execute();

								$result = $stmt->fetch(PDO::FETCH_ASSOC);

								echo "<div class='w3-padding'>Logged in as <span class='vcItalic'>" . $result["first"] . "&nbsp;" . $result["last"] . "</span></div>";

							}
							catch(PDOException $e) {
								echo "Error: " . $e->getMessage();
							}
							$conn = null;

						  ?>
			<input type="text" class="contact" id="email_contact" name="email_contact" value="<?php echo $result["email"] ?>" style="display: none" />
				<div id="cv_email" class="contactV w3-padding w3-text-theme-required" style="display: none"></div>
			<input type="text" class="contact" id="name_contact" name="name_contact" value="<?php echo $result["first"] . " " . $result["last"] ?>" style="display: none" />
				<div id="cv_name" class="contactV w3-padding w3-text-theme-required" style="display: none"></div>
					<?php
					  } ?>
					<label>Topic:</label>
				<select id="topic_contact" name="topic_contact" class="w3-input w3-margin-top contact">
					<option value="question">General question</option>
					<option value="order">Order I placed</option>
					<option value="custom">Custom work</option>
				</select>
					<div id="cv_topic" class="contactV w3-padding w3-text-theme-required" style="display: none"></div>
					<label>Details:</label>
				<textarea class="contact w3-input w3-margin-top" id="details_contact" style="width: 100%"></textarea>
					<div id="cv_details" class="contactV w3-padding w3-text-theme-required" style="display: none"></div>
			<div class="w3-row w3-padding-24">
				<div class="w3-button w3-theme w3-padding w3-half" onClick="postContact()">Submit</div>
				<div class="w3-button w3-theme-alertPink w3-padding w3-half" onclick="document.getElementById('contact_modal').style.display='none'">Cancel</div>	
			</div>
				
			</form>