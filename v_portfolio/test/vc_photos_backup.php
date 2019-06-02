<!-- PHOTO GRID - MAIN PAGE -->
<div id="myGrid" class="w3-row" style="margin-top:120px;" ng-controller="inventoryCtrl">

<!-- image tiles -->
  <div class="vcImageTile w3-third w3-card w3-display-container w3-hover-opacity w3-hover-theme" ng-repeat="x in title">
	  
	<div class="vcImageTileBar w3-theme-l3 w3-cell-row w3-opacity">
		  <!--<div class="w3-container w3-cell"><img src="../branding_icons/Icon_favorites.svg" alt="favorites icon" />&nbsp;{{x.num_favs}}</div>-->
		<div class="w3-container w3-cell"><span class="vcicon icon-favoritesvc"></span>&nbsp;{{x.num_favs}}</div>
		  <div class="w3-container w3-cell"><span class="vcicon icon-commentsvc"></span>&nbsp;{{x.num_favs}}</div>
		  <div class="w3-container w3-cell"><span class="vcicon icon-sharevc"></span></div>
    </div><!-- end image tileBar -->
	  
		<div class="vcImage"> 
			<a href="../images/{{ x.image_link }}" ><img src="../images/{{ x.image_link }}" alt="{{x.title}}"  style="width:100%" /></a>
		</div> 
	  <div class="vcImageTileName w3-display-topleft w3-theme-light w3-opacity-min w3-hide" style="width: 100%;">
      <div class="">{{ x.title }}</div>
    </div>

  </div> <!-- end image tiles -->
	
</div>

<?php
include("../components/main_script.php");
?>