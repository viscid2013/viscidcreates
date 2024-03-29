<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<!--<body ng-app="myApp" ng-controller="inventoryCtrl">-->
<body>
	
<!-- BEGIN SITEWIDE HEADER CONTENT -->

<!-- Sidebar -->
<nav class="w3-sidebar w3-top w3-theme-d2 w3-animate-top w3-xxlarge modalToHide" style="display:none;padding-top:50px; z-index: 4;" id="mySidebar">
  <a href="javascript:void(0)" onclick="w3_close()" class="w3-button w3-black w3-xxlarge w3-padding w3-display-topright" style="padding:6px 24px">
    <i class="fa fa-remove"></i>
  </a>
  <div class="w3-bar-block w3-center">
    <a href="vc_home.php" class="w3-bar-item w3-button w3-text-grey w3-hover-black">Home</a>
    <a href="vc_account.php" class="w3-bar-item w3-button w3-text-grey w3-hover-black">Account</a>
    <a href="#" class="w3-bar-item w3-button w3-text-grey w3-hover-black">Contact</a>
	<a href="vc_bio.php" class="w3-bar-item w3-button w3-text-grey w3-hover-black">Bio</a>
  </div>
</nav>	
	
<!-- Behind-Sidebar -->
<a href="javascript:void(0)" onclick="w3_close()">
	<nav id="transBackMain" class="w3-sidebar w3-top w3-white w3-xxlarge w3-opacity-min" style="display:none;padding-top:150px; z-index: 2;"></nav>	
</a> 
	
<div class="w3-top" style="z-index: 1">
	
<!-- Header 3.0 -->
	
<div class="w3-bar w3-white">
  <div class="w3-bar-item"><span class="w3-button w3-xlarge w3-white" onclick="w3_open()"><i class="fa fa-bars"></i></span></div>
 	<div class="logoTypeBar w3-bar-item w3-button w3-xlarge w3-center">
		<a class="iconlink" href="vc_home.php"><img class="logoTypeImage" src="../branding_icons/vc_logotype.svg" alt="viscid creates title image" /></a>
	</div>
  <div class="w3-bar-item w3-button w3-xlarge w3-right w3-hide-small">
	  <a class="iconlink" href="javascript:void(0)" onclick="">
	  	<span class="vcicon icon-cartvc"></span>
	  </a>
	</div>
  <div class="w3-bar-item w3-button w3-xlarge w3-right">
	  <a class="iconlink" href="vc_account.php">
	  	<span class="vcicon icon-accountvc"></span>
	  </a>
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
</body>
</html>