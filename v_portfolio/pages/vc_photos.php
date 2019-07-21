<script>
	

	
  window.fbAsyncInit = function() {
    FB.init({
      appId            : '960610207610265',
      autoLogAppEvents : true,
      xfbml            : true,
      version          : 'v3.3'
    });
  };
	
function doFB(val){
	var val = val;
	  FB.ui({
  			method: 'share',
		  	href: val,
  			action_type: 'og.likes',
  			action_properties: JSON.stringify({
    			object: "http://beamcreates.com/v_portfolio/branding_icons/vc_logoSymbol_PNG.png",
  		})
}, function(response){
  // Debug response (optional)
  console.log(response);
});
	
}	  

function doTumb(tVal){
	var tval = tVal;
	window.open('http://tumblr.com/widgets/share/tool?canonicalUrl=' + tval, "_blank", "toolbar=yes,scrollbars=yes,top=100,left=100,width=540,height=600");
}
	
	

</script>
<script async defer src="https://connect.facebook.net/en_US/sdk.js"></script>



<div id="share" class="w3-border w3-white w3-card w3-padding-small w3-center w3-container viewShare">
	<header class="w3-container w3-theme">
		<h4>Share it!</h4>
	</header>
		<span class="w3-large w3-button w3-display-topright" onClick="document.getElementById('share').style.display = 'none';">&times;</span>
		<div id="fbBtn" class="w3-button" value="" onclick="doFB(this.value)">
			<img src="../branding_icons/flogo-grey.png" alt="fb logo" style="width: 20px" />
		</div>
		<div id="tumBtn" class="w3-button" value="" onclick="doTumb(this.value)">
			<img src="../branding_icons/ios-black.png" alt="tumblr logo" style="width: 20px" />
		</div>
		<div id="linkBtn" class="w3-button" value="" onclick="doLink(this.value)">
			<img src="../branding_icons/link-icon.png" alt="link copy icon" style="width: 20px" />
		</div>
			<div id="linkShow" style="display: none;" class="w3-white w3-padding-small">
				<input type="url" id="imgUrl" class="w3-input w3-border" value="" />
					<div class="w3-button w3-gray" onClick="copyText('imgUrl')" style="cursor: pointer;">-></div>
			</div>
		</div>

<!-- begin slideshow modal -->

   <div id="slides_modal" class="w3-modal w3-animate-opacity">
    <div id="slides_modal_content" class="w3-modal-content w3-card w3-animate-zoom w3-padding">
	<header class="w3-container w3-theme">
		<span onclick="document.getElementById('slides_modal').style.display='none'" class="w3-button w3-display-topright" style="font-size: 200%">&times;</span>
	</header>
		
	<div class="w3-content w3-display-container vcSlidesTile" id="slideTileContainer" style="position: relative">
		<div id="addToCartIndicator" class="w3-theme-d3 w3-opacity" style="display: none; width: 100%; height: 100%; position: absolute; right: 0px;"></div>
		
	<?php include("../components/query_slides.php"); ?>
		
		  <button class="w3-button w3-black w3-display-left slideButton" onclick="plusDivs(-1)" style="z-index: 0; height: 98%">&#10094;</button>
		  <button class="w3-button w3-black w3-display-right slideButton" onclick="plusDivs(1)" style="z-index: 0; height: 98%">&#10095;</button>
		</div>
		
		</div><!-- end modal content div-->

    </div> <!-- end modal outer div -->


<!-- begin slideshow modal -->
<!-- PHOTO GRID - MAIN PAGE -->
<div id="myGrid" class="w3-row" style="margin-top:120px;">

<?php include('../components/query_inventory.php') ?>
	
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

					if( isset( $_REQUEST['imgOpen'] ) ) {
						$imgOpenId = $_REQUEST['imgOpen'];
						echo "<script>imgOpen('img_{$imgOpenId}');</script>";
						//echo "<div onload='imgOpen({$imgOpenId})'></div>";
					}


				?>
<script id="tumblr-js" async src="https://assets.tumblr.com/share-button.js"></script>
