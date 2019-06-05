
	
<!-- BEGIN SITEWIDE HEADER CONTENT -->

<!-- Sidebar - menu -->
<nav class="w3-sidebar w3-top w3-theme-d2 w3-animate-top w3-xlarge modalToHide" style="display:none;padding-top:50px; z-index: 4;" id="mySidebar">
  <a href="javascript:void(0)" onclick="w3_close('mySidebar')" class="w3-button w3-black w3-xlarge w3-padding w3-display-topright" style="padding:6px 24px">
    <i class="fa fa-remove"></i>
  </a>
  <div class="w3-bar-block w3-center">
    <a href="vc_home.php" class="w3-bar-item w3-button w3-text-light-grey w3-hover-black">Home</a>
	<a href="#" class="w3-bar-item w3-button w3-text-light-grey w3-hover-black">Contact</a>
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
	
<!-- Sidebar - login -->
<nav class="w3-sidebar w3-top w3-theme-dark w3-animate-top modalToHide w3-padding" style="display: none; font-size: 120%; padding-top: 50px; right:0; z-index: 4; margin: 0 auto;" id="loginSidebar">
  <a href="javascript:void(0)" onclick="w3_close('loginSidebar')" class="w3-button w3-black w3-xlarge w3-padding w3-display-topright" style="padding:6px 24px">
    <i class="fa fa-remove"></i>
  </a>
  <div id="loginFormSidebar" class="w3-container" style="width: 90%">
	  <!-- replace with account options if logged in? -->
	</div>
</nav>
	
<!-- Behind-Sidebars -->
<a href="javascript:void(0)" onclick="w3_close()">
	<nav id="transBackMain" class="w3-sidebar w3-top w3-white w3-xxlarge w3-opacity-min" style="display:none;padding-top:150px; z-index: 2;"></nav>	
</a> 
	
<div class="w3-top" style="z-index: 1">
	
<!-- Header 3.0 -->
	
<div class="w3-bar w3-white">
  <div class="w3-bar-item"><span class="w3-button w3-xlarge w3-white" onclick="w3_open('mySidebar','50%')"><i class="fa fa-bars"></i></span></div>
 	<div class="logoTypeBar w3-bar-item w3-button w3-xlarge w3-center">
		<a class="iconlink" href="vc_home.php"><img class="logoTypeImage" src="../branding_icons/vc_logotype.svg" alt="viscid creates title image" /></a>
	</div>
  <div class="w3-bar-item w3-button w3-xlarge w3-right" style="position: relative;">
	  <a class="iconlink" href="javascript:void(0)" onclick="">
	<?php if ( isset($_SESSION['user_cart']) || isset($_SESSION['guest_cart']) ) { ?>
		  <span class="w3-round w3-theme-d3" style="position: absolute; right: 2; bottom: 2; font-size: 60%; padding: 0px 2px 0px 2px">0</span>
	  	<span id="cartIcon" class="vcicon icon-cartvc w3-text-theme"></span>
		 	<?php }

	  else{
	  ?> 
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
			<input type="text" style="width:80%" />
			<div class="w3-button w3-display-right w3-hide-large w3-hide-medium" style="height:100%">
				<a class="iconlink" href="javascript:void(0)" onclick="filter_open()">
					<span class="vcicon icon-filtervc"><span class="path1"></span><span class="path2"></span></span>
				</a>
			</div>
		</div>
  		<div class="w3-half w3-display-right w3-padding-small w3-theme-l5 w3-hide-small" style="height:100%">
			<span class="w3-display-right" style="font-size: 120%;font-weight: 400">
				Filter: 
				4x6&nbsp;<input type="checkbox" />&nbsp;|&nbsp;
				5x7&nbsp;<input type="checkbox" />&nbsp;|&nbsp;
				11x17&nbsp;<input type="checkbox" />
			</span>
		</div>
	</div>
	
<!-- Phone filter div -->
	
<div id="filtersMobile" class="w3-center w3-padding-small w3-margin-bottom w3-theme-l5 w3-hide-medium w3-hide-large w3-animate-left w3-card" style="height:50px;display: none;">
			<span style="font-size: 120%;font-weight: 400">
				Filter: 
				4x6&nbsp;<input type="checkbox" />&nbsp;|&nbsp;
				5x7&nbsp;<input type="checkbox" />&nbsp;|&nbsp;
				11x17&nbsp;<input type="checkbox" />
			</span>
		</div>	

	</div> <!-- end div top -->	

<!-- END SITEWIDE HEADER CONTENT -->
