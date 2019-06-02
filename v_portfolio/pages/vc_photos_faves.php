<!-- PHOTO LIST - FAVS -->
<div id="myFavsGrid" class="w3-row" style="margin-top:10px;" ng-app="myApp" ng-controller="myfavsCtrl" style="position: relative;">

<!-- image tiles -->
  <div class="{{ $index >= 10 ? 'w3-hide' : '' }} vcImageTile w3-third w3-card w3-display-container w3-hover-opacity w3-hover-theme w3-center" ng-repeat="x in title">
	  
	<div class="vcImageTileBar w3-theme-l3 w3-cell-row w3-opacity">
		  <div class="w3-container w3-cell"><span class="vcicon icon-favoritesvc"></span>&nbsp;{{x.num_favs}}</div>
		  <div class="w3-container w3-cell"><span class="vcicon icon-commentsvc"></span>&nbsp;{{x.num_favs}}</div>
		  <div class="w3-container w3-cell"><span class="vcicon icon-sharevc"></span></div>
    </div><!-- end image tileBar -->
	  
		<div class="vcImage"> 
			<a href="../images/{{ x.image_link }}" ><img src="../images/{{ x.image_link }}" alt="{{x.title}}"  style="width:90%" /></a>
		</div> 
	  <div class="vcImageTileName w3-display-topleft w3-theme-light w3-opacity-min" style="width: 100%;">
      <div id="imgId_{{ x.iid }}" class="w3-hide">{{ $index + 1 }}</div>
		  <!--<div class="{{ $index >= 10 ? 'w3-show' : 'w3-hide' }}">Show all</div>-->
		  
    </div>

  </div> <!-- end image tiles -->
	
<!-- show more tile not mobile -->
  <div class="{{ $index >= 10 ? 'w3-hide' : 'w3-show' }} w3-hide-small vcShowAllTile w3-third w3-card w3-display-container w3-theme w3-hover-opacity w3-hover-theme w3-center">
	  <div><a class="iconlink" href="">Browse All</a></div>
  </div> <!-- end show more tile not-mobile -->
	
<!-- show more tile FOR mobile -->
  <div class="{{ $index >= 3 ? 'w3-hide' : 'w3-show' }} w3-hide-large w3-hide-medium vcShowAllTile w3-third w3-card w3-theme w3-hover-opacity w3-hover-theme w3-center">
	  <div><a class="iconlink" href="">Browse All</a></div>
  </div> <!-- end show more tile FOR-mobile -->
	
</div>

<?php
include("../components/main_script.php");
?>