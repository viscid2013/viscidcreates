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
