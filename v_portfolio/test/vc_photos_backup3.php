<!-- begin slideshow modal -->

   <div id="slides_modal" class="w3-modal w3-animate-opacity">
    <div id="slides_modal_content" class="w3-modal-content w3-card w3-animate-zoom w3-padding">
	<header class="w3-container w3-theme">
		<span onclick="document.getElementById('slides_modal').style.display='none'" class="w3-button w3-display-topright" style="font-size: 200%">&times;</span>
	</header>
		
	<div class="w3-content w3-display-container vcSlidesTile" style="position: relative">
		<div id="addToCartIndicator" class="w3-theme-d3 w3-opacity" style="display: none; width: 100%; height: 100%; position: absolute; right: 0px;"></div>
		
	<?php include("../components/query_slides.php"); ?>
		
		  <button class="w3-button w3-black w3-display-left slideButton" onclick="plusDivs(-1)" style="z-index: 0; height: 98%">&#10094;</button>
		  <button class="w3-button w3-black w3-display-right slideButton" onclick="plusDivs(1)" style="z-index: 0; height: 98%">&#10095;</button>
		</div>
		
		</div><!-- end modal content div-->

    </div> <!-- end modal outer div -->


<!-- begin slideshow modal -->
<!-- PHOTO GRID - MAIN PAGE -->
<div id="myGrid" class="w3-row" style="margin-top:120px;" ng-controller="inventoryCtrl">

<!-- image tiles -->
  <div class="vcImageTile w3-third w3-card w3-display-container w3-hover-theme" ng-repeat="x in title">
	  
	<div class="vcImageTileBar w3-theme-l3 w3-cell-row w3-opacity">
		  <!--<div class="w3-container w3-cell"><img src="../branding_icons/Icon_favorites.svg" alt="favorites icon" />&nbsp;{{x.num_favs}}</div>-->
		<div class="w3-container w3-cell"><span class="vcicon icon-favoritesvc"></span>&nbsp;{{x.num_favs}}</div>
		  <div class="w3-container w3-cell"><span class="vcicon icon-commentsvc"></span>&nbsp;{{x.num_favs}}</div>
		  <div class="w3-container w3-cell"><span class="vcicon icon-sharevc"></span></div>
    </div><!-- end image tileBar -->
	  
		<div class="vcImage"> 
			<span class="imgOpen" id="img_{{ x.iid }}" onClick="imgOpen(this.id)"><img src="../images/{{ x.image_link }}" alt="{{x.title}}"  style="width:100%" /></span>
		</div> 
	  <div class="vcImageTileName w3-display-topleft w3-theme-light w3-opacity-min w3-hide" style="width: 100%;">
      <div class="">{{ x.title }}</div>
    </div>
	  
	  			<!-- begin mobile order bar -->
			<div class="w3-container w3-theme-l3 w3-hide-large w3-hide-medium orderBarMob" style="width: 100%; position: relative; font-size:100%;">  
			<div class="w3-container w3-padding" style="width: 100%">
			  <select id="mSize_{{x.iid}}" class="w3-select w3-border" name="option">
				  <option value="" disabled selected>Choose a size</option>
				  <option value="0">4X6</option>
				  <option value="1">5X7</option>
				  <option value="2">11X17</option>
				</select>
			</div>
			<div class="w3-container w3-padding" style="width: 100%">
				<div id="{{x.iid}}" class="w3-button w3-block w3-theme-action" onclick="addToCart(this.id, 'mobile')">Add to Cart</div>
			</div>
				<div id="mAddToCartMsg_{{x.iid}}" class="w3-block w3-theme w3-padding mAddCartMsgs"></div>
			</div>
			<!-- end mobile order bar -->

  </div> <!-- end image tiles -->
	
</div>
				<script>
				var slideIndex;
				var currSlide;
					
				function imgOpen(imgId){
					
					var dw = window.screen.width;
					
					if( dw > 600 ) {
					   
					var iid1 = imgId.split("_");
					var iid = iid1[1];
					//alert(iid);
					window.currSlide  = Number(document.getElementById("slide_" + iid).value);
					window.slideIndex = window.currSlide;
					//alert(slideIndex);
					showDivs(window.slideIndex );
					var slidesModal = document.getElementById("slides_modal");
					slidesModal.style.display = "block";  
					   
					   }
					else{
						return false;
					}
					


				}


				/* ORIGINAL SCRIPT */

				
				//showDivs(slideIndex);

				function plusDivs(n) {
				  showDivs(window.slideIndex += n);
				}

				function showDivs(n) {
					  var i;
					  var x = document.getElementsByClassName("vcSlides");
					  if (n > x.length) {slideIndex = 1}
					  if (n < 1) {slideIndex = x.length}
					  for (i = 0; i < x.length; i++) {
						x[i].style.display = "none";  
					  }
					  x[slideIndex-1].style.display = "block";  
					}
				
					
				</script>
<?php
//include("../components/main_script.php");
?>