<?php 

session_start();
if (isset($_SESSION['id'])){
	$uid = $_SESSION['id'];
}

include("vcinfo.inc");

//echo '{"order":';

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT avatar_link
							FROM users
							WHERE uid = :uid
							"); 
    $stmt->bindParam(':uid', $uid);
	$stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
		$avatar = $result['avatar_link'];

}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
	
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
	<!--<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>-->
	<!--<link rel="stylesheet" href="../styles/jquery-ui.theme.css">-->
	<script src="../components/draggable_background.js"></script>
	
<style type="text/css">
	
	
	.editAvatar{
		
	}
	
	.avatar{
		border-radius: 50%;
		overflow: hidden;
		border: 1px solid #4a334d;
	}
	
	.box{
		border-radius: 50%;
		overflow: hidden;
		position: relative;
		width: auto;		/* desired width */
		border: 1px solid #4a334d;
	}
	.box:before{
		content: "";
		display: block;
		padding-top: 100%; 	/* initial ratio of 1:1*/
	}
	
	.content{
		position:  absolute;
		top: 0;
		left: 0;
		bottom: 0;
		right: 0;
		background-image: url("<?php echo $avatar; ?>");
		background-position: 0px 0px;
		background-repeat: no-repeat;
		background-size: 100%;
	}

	.slider {
		  -webkit-appearance: none;
		  width: 100%;
		  height: 15px;
		  border-radius: 5px;   
		  background: #bfa3c2;
		  outline: none;
		  opacity: 0.7;
		  -webkit-transition: .2s;
		  transition: opacity .2s;
		}

	.slider::-webkit-slider-thumb {
		  -webkit-appearance: none;
		  appearance: none;
		  width: 25px;
		  height: 25px;
		  border-radius: 50%; 
		  background: #4a334d;
		  cursor: pointer;
		}

	#myRange_size.slider::before {
		opacity: 0;
	}
	
	.slider::-moz-range-thumb {
		  width: 25px;
		  height: 25px;
		  border-radius: 50%;
		  background: #4a334d;
		  cursor: pointer;
		}
	
	.slidecontainer{
		position: absolute;
		width: 90%;
		z-index: 4;
		top: 0px;
		left: 10px;
	}

.w3-theme-alertPink {color:#fff !important; background-color:#F0415B !important}
.w3-theme-action {color:#fff !important; background-color:#4a334d !important}	
	</style>
	
<title>Avatar Edit</title>
</head>

<body>
<div id="boxid" style="position: relative; margin: 0 auto; height: auto; width: 200px;">
	<div class="slidecontainer">
			<input type="range" min="85" max="120" value="100" class="slider" id="myRange_size">
		</div>
			<div id="" class="box">
				<div id="acct_avatar" class="content"></div>
			</div>
	<!--<div id="demoS">0</div>
	<div id="demoP">0</div>-->
	<form method="post" class="w3-margin-top" action="../components/query_update_avatar.php">
		<input type="text" id="posVal" name="bgPos" style="display: none;">
		<input type="text" id="sizeVal" name="bgSize" style="display: none;">
	<button class="vc_button_form vc_boxshadow w3-button w3-theme-l3" type="submit">SAVE</button>
		<div class="vc_button_form w3-button vc_boxshadow w3-theme-alertPink"  onclick="document.getElementById('edit_avatar_modal').style.display='none'">Cancel</div>
	</form>
</div>	
	<div style="overflow: hidden; width: 1px; height: 1px;"><img id="hidePic" src="<?php echo $avatar; ?>" /></div>

<script>
$(document).ready(function(){

$('#acct_avatar').backgroundDraggable({
  bound: true, 
  //axis: 'x' 
// 'x' or 'y', If specified, restrict dragging along x or y axis.
  });
	
	/*var sliderV = document.getElementById("myRange_size");
	var bgV = document.getElementById("acct_avatar").style.backgroundSize;
	alert(bgV);*/
	

	/*var bgs = $('#acct_avatar').css("background-size");
	//$("#demoS").html(bgs);	
	document.getElementById('demoS').innerHTML = bgs;*/

	$('#acct_avatar').on('mouseup mouseleave touchend', function(){
		var aaPosYa = $('#acct_avatar').css("backgroundPositionY");
			var aaPosY = Number(aaPosYa.replace("px",""));
		var aaPosXa = $('#acct_avatar').css("backgroundPositionX");
			var aaPosX = Number(aaPosXa.replace("px",""));

		//var newPer = Number($("#demoS").html());
		var newPer = document.getElementById("acct_avatar").style.backgroundSize;

		$("#posVal").val( $('#acct_avatar').css("backgroundPosition") );

		if( newPer !== 0 && newPer !== "0" ){
			var aaSizeH = ( $( "#hidePic" ).height()/100 )*newPer;
			var aaSizeW = ( $( "#hidePic" ).width()/100 )*newPer;		   
		   }
		else{
			var aaSizeH = $( "#hidePic" ).height();
			var aaSizeW = $( "#hidePic" ).width();
		}
		
		//document.getElementById('demoP').innerHTML = "Is PosX:" + aaPosX  +" less than Half Image Width? ->" + aaSizeW + "/2 * -1=" + ( (aaSizeW/3)*-1 );
		
		if( aaPosX <= -75 ){
		   	$('#demoP').html(aaPosX + "->TOO FAR!");
			$('#acct_avatar').animate({ backgroundPositionX : "0px" }, "slow");
		   }
		if( aaPosY <= -75 ){
		   	$('#demoP').html(aaPosY + "->TOO FAR!");
			$('#acct_avatar').animate({ backgroundPositionY : "0px" }, "slow");
		   }
		
		/*if( aaPosX <= ( (aaSizeW/4)*-1 ) || aaPosX >= (aaSizeW/4) ){
		   	$('#demoP').html(aaPosX + "->TOO FAR!");
			$('#acct_avatar').animate({ backgroundPositionX : "0px" }, "slow");
		   }
		if( aaPosY <= ( (aaSizeH/4)*-1 ) || aaPosY >= (aaSizeH/4) ){
		   	$('#demoP').html(aaPosY + "->TOO FAR!");
			$('#acct_avatar').animate({ backgroundPositionY : "0px" }, "slow");
		   }*/
		
	});

	
});


var sliderS = document.getElementById("myRange_size");
var outputS = document.getElementById("demoS");
	var saveS = document.getElementById("sizeVal");
	
var bg = document.getElementById("acct_avatar");
	
// Update the current slider value (each time you drag the slider handle)
sliderS.oninput = function() {
  //outputS.innerHTML = this.value;
	bg.style.backgroundSize = this.value + "%";
	var bgs = $('#acct_avatar').css("background-size");
	//outputS.innerHTML = this.value;
	saveS.value = this.value;

}


	</script>
	
	
</body>
</html>
