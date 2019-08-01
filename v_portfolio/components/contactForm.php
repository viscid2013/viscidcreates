<form name="contact_form" id="contact_form">
			<?php if (!isset($_SESSION['loggedin'])) { ?>
				<label>Email Address:</label>
			<input type="text" class="w3-input w3-margin-top contact" id="email_contact" name="email_contact" value="" />
				<label>Name:</label>
			<input type="text" class="w3-input w3-margin-top contact" id="name_contact" name="name_contact" value="" />
				  	<?php }

					  else{
						  	include("../components/query_contact_info.php");	  
						  ?>
			<input type="text" class="contact" id="email_contact" name="email_contact" value="<?php echo $result["email"] ?>" style="display: none" />
			<input type="text" class="contact" id="name_contact" name="name_contact" value="<?php echo $result["first"] . " " . $result["last"] ?>" style="display: none" />				
					<?php
					  } ?>
					<label>Topic:</label>
				<select id="topic_contact" name="topic_contact" class="w3-input w3-margin-top contact">
					<option value="question">General question</option>
					<option value="order">Order I placed</option>
					<option value="custom">Custom work</option>
				</select>
					<label>Details:</label>
				<textarea class="contact w3-input w3-margin-top" id="details_contact" style="width: 100%"></textarea>
				<!--<textarea class"w3-input w3-margin-top contact" id="details_contact" name="details_contact" style="width: 100%"></textarea>-->
			<div class="w3-row w3-padding-24">
				<div class="w3-button w3-theme w3-padding w3-half" onClick="postContact()">Submit</div>
				<div class="w3-button w3-theme-alertPink w3-padding w3-half" onclick="document.getElementById('contact_modal').style.display='none'">Cancel</div>	
			</div>
				
			</form>