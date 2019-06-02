<!doctype html>
<html>
<!-- vc_slides.php v1.5-->
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="../styles/vstyle_W3.css">
	<link rel="stylesheet" href="../styles/vc_accordion.css">
	<link rel="stylesheet" href="../styles/vc_core/style.css">
<link href="https://fonts.googleapis.com/css?family=Assistant:200,400" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body,h1 {font-family: 'Assistant', sans-serif}
img {margin-bottom: -7px}
.w3-row-padding img {margin-bottom: 12px};
	
	.vcSlides {
		display: none;
	}
	
	.vcSlidesTile{
		width: 75%;
	}
	
	.slideButton {
		height: 100%;
		opacity: 0.35;
	}
	
</style>

<body>
	
<div class="w3-content w3-display-container vcSlidesTile">
	
	<?php include("query_slides.php"); ?>

  <button class="w3-button w3-black w3-display-left slideButton" onclick="plusDivs(-1)">&#10094;</button>
  <button class="w3-button w3-black w3-display-right slideButton" onclick="plusDivs(1)">&#10095;</button>
</div>


<script>
var slideIndex = 1;
showDivs(slideIndex);

function plusDivs(n) {
  showDivs(slideIndex += n);
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
	
</body>
</html>