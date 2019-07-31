	
<!-- BEGIN SITEWIDE HEADER CONTENT -->

<!-- Sidebar - menu -->
<nav class="w3-sidebar w3-top w3-theme-d2 w3-animate-top w3-xlarge modalToHide" id="mySidebar">
  <a href="javascript:void(0)" onclick="w3_close('mySidebar')" class="w3-button w3-black w3-xlarge w3-padding w3-display-topright" style="padding:6px 24px">
    <i class="fa fa-remove"></i>
  </a>
  <div class="w3-bar-block w3-center">
    <a href="vc_home.php" class="w3-bar-item w3-button w3-text-light-grey w3-hover-black">Home</a>
	<a href="#" class="w3-bar-item w3-button w3-text-light-grey w3-hover-black" onclick="openContact()">Contact</a>
	<a href="vc_bio.php" class="w3-bar-item w3-button w3-text-light-grey w3-hover-black">Bio</a>
	<?php if (!isset($_SESSION['loggedin'])) { ?>
	<a href="vc_account.php" class="w3-bar-item w3-button w3-text-light-grey w3-hover-black">Log In</a>
	  	<?php }

	  else{
	  ?>
	<a href="vc_account.php" class="w3-bar-item w3-button w3-text-light-grey w3-hover-black">Account</a>
	<a href="../components/vc_logout.php" class="w3-bar-item w3-button w3-text-light-grey w3-hover-black">Log Out</a>

	  <?php     		  
		  
	  }
	  
	  ?>
  </div>
</nav>	

<!-- Begin Contact Modal -->

   <div id="contact_modal" class="w3-modal w3-animate-opacity">
    <div id="contact_modal_content" class="w3-modal-content w3-card w3-animate-zoom w3-center">
	<header class="w3-container w3-theme">
		<h3>Contact Me!</h3>
		<span onclick="document.getElementById('contact_modal').style.display='none'" class="w3-button w3-display-topright" style="font-size: 170%">&times;</span>
	</header>
		<div id="contactContent" class="w3-container w3-card w3-padding">
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
		</div>
    </div>
  </div>

<!-- Begin Cart Modal -->

   <div id="cart_modal" class="w3-modal w3-animate-opacity">
    <div id="cart_modal_content" class="w3-modal-content w3-card w3-animate-zoom w3-center">
	<header class="w3-container w3-theme">
		<h3>Your Cart</h3>
		<span onclick="document.getElementById('cart_modal').style.display='none'" class="w3-button w3-display-topright" style="font-size: 170%">&times;</span>
	</header>
		<div id="cartContent" class="w3-container">
				
		</div>
    </div>
  </div>

<!-- End Cart Modal -->

<!-- Behind-Sidebars -->
<a href="javascript:void(0)" onclick="w3_close()">
	<nav id="transBackMain" class="w3-sidebar w3-top w3-white w3-xxlarge w3-opacity-min"></nav>	
</a> 
	
<div id="topHeader" class="w3-top">
	
<!-- Header 3.0 -->
	
<div class="w3-bar w3-white">
  <div class="w3-bar-item"><span class="w3-button w3-xlarge w3-white" onclick="w3_open('mySidebar','50%')"><i class="fa fa-bars"></i></span></div>
 	<div class="logoTypeBar w3-bar-item w3-button w3-xlarge w3-center">
		<a class="iconlink" href="vc_home.php"><img class="logoTypeImage" src="../branding_icons/vc_logotype.svg" alt="viscid creates title image" /></a>
	</div>
  <div class="w3-bar-item w3-button w3-xlarge w3-right" style="position: relative;">
	  <a class="iconlink" href="javascript:void(0)" onClick="loadPage('../components/query_cart_contents.php', updateCartContent)">
	<?php if ( isset($_SESSION['id_sizes']) ) { 
		
			$cartNumR = count($_SESSION['id_sizes'],COUNT_RECURSIVE);
			$cartNumA = count($_SESSION['id_sizes']);
			$cartNum = ($cartNumR - $cartNumA);

		  ?>
		  <span id="cartNumSpan" class="w3-round w3-theme-d3" style="position: absolute; right: 2; bottom: 2; font-size: 60%; padding: 0px 2px 0px 2px"><?php echo $cartNum;  ?></span>
	  	<span id="cartIcon" class="vcicon icon-cartvc w3-text-theme"></span>
		 	<?php }

	  else{
	  ?> 
		  <span id="cartNumSpan" class="w3-round w3-theme-d3" style="position: absolute; right: 2; bottom: 2; font-size: 60%; padding: 0px 2px 0px 2px"><?php echo $cartNum;  ?></span>
	  	<span id="cartIcon" class="vcicon icon-cartvc"></span>
	<?php     		  
		  
	  }
	  
	  ?>
	  
	  </a>
	</div>
  <div class="w3-bar-item w3-button w3-xlarge w3-right">
	
	<?php if (!isset($_SESSION['loggedin'])) { ?>
	  <a href="vc_account.php" class="iconlink">
		  	<span class="vcicon icon-accountvc w3-hide-small w3-hide-medium"></span>
		</a>
	  <a href="vc_account.php" class="iconlink">
	  		<span class="vcicon icon-accountvc w3-hide-large w3-hide-small"></span>
		  </a>
	  <!--<a href="vc_account.php" class="iconlink">
	  		<span class="vcicon icon-accountvc w3-hide-large w3-hide-medium"></span>
	  </a>-->
	<?php }

	  else{
	  ?>		
	  <a href="vc_account.php" class="iconlink">
		  	<span class="vcicon icon-accountvc w3-hide-small w3-hide-medium w3-text-theme"></span>
		</a>
	  <a href="vc_account.php" class="iconlink">
	  		<span class="vcicon icon-accountvc w3-hide-large w3-hide-small w3-text-theme"></span>
		  </a>
	  <!--<a href="vc_account.php" class="iconlink">
	  		<span class="vcicon icon-accountvc w3-hide-large w3-hide-medium w3-text-theme"></span>
	  </a>-->
	  
	<?php     		  
		  
	  }
	  
	  ?>
	  
	</div>
</div>
	
<!--<div class="w3-clear"></div>-->	
<!-- Search and Filters -->	
	
	<div class="vc_boxshadow w3-row w3-padding w3-display-container" style="height:40px;">
  		<div class="searchRow w3-half w3-display-left w3-padding-small w3-theme-l4" style="height:100%">
			<span class="vcicon icon-searchvc" style="font-size: 120%"></span>
			<input id="headerSearch" onKeyUp="filterSearch()" type="text" style="width:80%" />
			<div class="w3-button w3-display-right w3-hide-large w3-hide-medium" style="height:100%">
				<a class="iconlink" href="javascript:void(0)" onclick="filter_open()">
					<span class="vcicon icon-filtervc"><span class="path1"></span><span class="path2"></span></span>
				</a>
			</div>
		</div>
  		<div class="w3-half w3-display-right w3-padding-small w3-theme-l5 w3-hide-small" style="height:100%">
			<span class="w3-display-right" style="font-size: 120%;font-weight: 400">
				Filter: 
				4x6&nbsp;<input class="sizeFilter" onChange="filterSearch()" type="checkbox" value="0" />&nbsp;|&nbsp;
				5x7&nbsp;<input class="sizeFilter" onChange="filterSearch()" type="checkbox" value="1" />&nbsp;|&nbsp;
				11x17&nbsp;<input class="sizeFilter" onChange="filterSearch()" type="checkbox" value="2" />
			</span>
		</div>
	</div>
	
<!-- Phone filter div -->
	
<div id="filtersMobile" class="w3-center w3-padding-small w3-margin-bottom w3-theme-l5 w3-hide-medium w3-hide-large w3-animate-left w3-card" style="height:50px;display: none;">
			<span style="font-size: 120%;font-weight: 400">
				Filter: 
				4x6&nbsp;<input class="sizeFilter" onChange="filterSearch()" type="checkbox" value="0" />&nbsp;|&nbsp;
				5x7&nbsp;<input class="sizeFilter" onChange="filterSearch()" type="checkbox" value="1" />&nbsp;|&nbsp;
				11x17&nbsp;<input class="sizeFilter" onChange="filterSearch()" type="checkbox" value="2" />
			</span>
		</div>	

	</div> <!-- end div top -->	

<!-- END SITEWIDE HEADER CONTENT -->
