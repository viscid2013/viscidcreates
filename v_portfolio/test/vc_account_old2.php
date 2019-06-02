<!doctype html>
<html>

<meta charset="utf-8">
<title>Viscid Creates Account</title>
<?php

include("../header/vc_header_main.php");

?>		
<body onload="loadLogin('loginAcctPg'); loadAvatar();">

<?php

include("../header/vc_header_menus.php");

if (!isset($_SESSION['loggedin'])) {
	
?>
<div class="w3-container" style="margin-top: 150px;">
	<div id="loginAcctPg" class="w3-container" style="margin: 0 auto">
		<?php //include("../components/vc_loginform.php"); ?>
	</div>
</div>
<?php
	
}//end logged in IF 

else {
	
?>
	
<div class="acctAccordionContainer w3-container" style="margin-top:150px;">

<h2 class="w3-border-bottom w3-border-gray w3-opacity-min" style="width: 50%">Account</h2>

<div class="accordion w3-block w3-border-bottom w3-border-theme w3-theme-l4 w3-left w3-padding-top">
<span class="vcicon icon-accountvc"></span>&nbsp;<span class="accountText">Profile</span></div>

<div id="Demo1" class="panel w3-container">
	<!-- begin avatar modal stuff -->
   <!--<div id="avatar_modal" class="w3-modal w3-animate-opacity">
    <div id="avatar_modal_content" class="w3-modal-content w3-card w3-animate-zoom w3-center" style="width: 55%;">
	<header class="w3-container w3-theme">
		<h3>Upload Profile Image</h3>
		<span onclick="document.getElementById('avatar_modal').style.display='none'" class="w3-button w3-display-topright" style="font-size: 170%">&times;</span>
	</header>
      <div class="w3-container w3-padding w3-row" style="font-size: 120%;">
		  
	<?php //include("../components/avatarEdit.html") ?>
		<div class="w3-col w3-half">
		  <form action="../components/upload.php" method="post" enctype="multipart/form-data">
			<div class="w3-block w3-border w3-left">
				<input type="file" name="fileToUpload" id="fileToUpload">
			  </div>
			<div class="w3-block w3-border w3-right">
				<input type="submit" value="Upload" name="submit" style="width: 100%; color:#fff !important; background-color:#4a334d !important">
			  </div>		
		</form>
		  </div>
      </div>
    </div>
  </div>-->
	<!-- end avatar modal stuff -->
	
	
<div class="w3-padding-24 w3-center" style="width: 85%">
	<div class="w3-padding">
		
			<div class="box">
		<div id="acct_avatar" class="content">
			<!--<img id="acct_avatar" class="editAvatar" alt="avatar" src="../uploads/benlogo.png" />-->
		</div>
	</div>
		
			<!--<img id="acct_avatar" class="acct_profile_img w3-circle w3-hover-opacity" src="" />-->
	</div>
	<div class="w3-padding">
		<div class="w3-bar">
			<!--<div class="vc_button_form vc_boxshadow w3-button w3-theme-l3" style="margin-right: 4px" onclick="w3_open('avatar_modal','100%')">Upload</div>-->
			<form id="av_form" action="../components/upload.php" method="post" enctype="multipart/form-data">
			<input type="file" name="fileToUpload" id="fileToUpload"><input type="submit" value="Upload" name="submit" style="">
			</form>
			
			<div class="vc_button_form w3-button vc_boxshadow w3-theme-alertPink" style="margin-left: 4px" onclick="submitAv()">Delete</div>
		</div>
		<div style="font-size: 110%">Username:&nbsp;[username]</div>
	</div>
</div>
<form class="w3-container w3-card w3-margin-bottom">
	<h3>Update Personal Info</h3>
	<p>
		<label>First Name</label>
		<input class="w3-input" type="text"></p>
	<p>
		<label>Last Name</label>
		<input class="w3-input" type="text"></p>
	<p>
		<label>Email</label>
		<input class="w3-input" type="text"></p>
	<p>
		<div class="w3-block w3-button vc_boxshadow w3-theme-action">Update</div></p>
</form>	
<form class="w3-container w3-card w3-margin-bottom">
	<h3>Update Password</h3>
	<p>
		<label>Current Password</label>
		<input class="w3-input" type="text"></p>
	<p>
		<label>New Password</label>
		<input class="w3-input" type="text"></p>
	<p>
		<label>Confirm New Password</label>
		<input class="w3-input" type="text"></p>
	<p>
		<div class="w3-block w3-button vc_boxshadow w3-theme-action">Update</div></p>
</form>	
</div>

<div class="accordion w3-block w3-border-bottom w3-border-theme w3-theme-l4 w3-left">
<span class="vcicon icon-billingvc"></span>&nbsp;<span class="accountText">Billing</span></div>

<div id="Demo2" class="panel w3-container">
	<div class="w3-left w3-card w3-padding w3-margin-bottom" style="width: 100%">
  		<h3>Payment Methods</h3>
			<div class="w3-padding"><span class="vcicon icon-editvc"><span class="path1"></span><span class="path2"></span></span>&nbsp;MyVisa</div>
		<div class="w3-padding"><span class="vcicon icon-editvc"><span class="path1"></span><span class="path2"></span></span>&nbsp;MyMasterCard</div>
			<div class="w3-padding"><span class="vcicon icon-addvc"></span>&nbsp;Add Payment Method</div>
		
	</div>
</div>

<div class="accordion w3-block w3-border-bottom w3-border-theme w3-theme-l4 w3-left">
<span class="vcicon icon-ordersvc"></span>&nbsp;<span class="accountText">Orders</span></div>

<div id="Demo3" class="panel w3-container">
	<!-- begin modal stuff -->
   <div id="orders_modal" class="w3-modal w3-animate-opacity">
    <div id="orders_modal_content" class="w3-modal-content w3-card w3-animate-zoom">
	<header class="w3-container w3-theme">
		<h2>Order Details</h2>
		<span onclick="document.getElementById('orders_modal').style.display='none'" class="w3-button w3-display-topright" style="font-size: 200%">&times;</span>
	</header>
      <div class="w3-container w3-center" style="font-size: 130%">
        <div id="order_id" class="w3-row"></div>
        <div id="order_title" class="w3-row"></div>
		<div id="order_date" class="w3-row"></div>
        <div id="order_status" class="w3-row"></div>
		<div id="order_tracking" class="w3-row"></div>
        <div id="order_paid" class="w3-row"></div>
		<div id="order_total" class="w3-row"></div>
		<div class="w3-row w3-margin-bottom">
		<div class="w3-half w3-container w3-margin-bottom"><button onClick="printReceipt(this.value)" value="" id="order_print" class="w3-block w3-button vc_boxshadow w3-theme-action">Print Receipt</button></div>
		<div class="w3-half w3-container w3-margin-bottom"><button onClick="openOrderQuery(this.value)" value="" id="order_ask" class="w3-block w3-button vc_boxshadow w3-theme-action">Ask a Question</button></div>
		</div>
      </div>
    </div>
  </div>

  		
	<!-- end modal stuff -->
	<div class="w3-left w3-card w3-padding w3-margin-bottom" style="width: 100%" ng-app="myApp" ng-controller="myordersCtrl">
  		<h3>Orders</h3>
			<div class="w3-padding w3-row w3-hover-opacity" style="max-width: 800px; cursor: pointer" ng-repeat="x in oid">
				<a href="#" id="oid_{{ x.oid }}" onclick="getID(this.id)">
				<div class="w3-third" style="color: #666666;">
					<span class="vcicon icon-viewvc"></span>&nbsp;{{ x.title }}
				</div>
				<div class="w3-third" style="color: #666666;">{{ x.oid }}</div>
				<div class="w3-third" style="color: #666666;">{{ x.date_created }}</div>
				</a>
			</div>
	</div>
</div>
	
<div class="accordion w3-block w3-border-bottom w3-border-theme w3-theme-l4 w3-left">
<span class="vcicon icon-favoritesvc"></span>&nbsp;<span class="accountText">Favorites</span></div>

<div id="imgFavsPanel" class="panel w3-container w3-center">
  <?php
	include("vc_photos_faves.php");
	?>
</div>
	
<div class="accordion w3-block w3-border-bottom w3-border-theme w3-theme-l4 w3-left">
<span class="vcicon icon-settingsvc"></span>&nbsp;<span class="accountText">Settings</span></div>

<div id="Demo5" class="panel w3-container">
  <div class="w3-left w3-card w3-padding w3-margin-bottom" style="width: 100%">
  		<h3>Order Notifications</h3>
			<div class="w3-padding w3-row" style="max-width: 800px;">
				<div class="w3-half" style="color: #666666; font-size: 140%; font-weight: 400;">Email Notices:&nbsp;</div>
				<div class="w3-half" style="color: #666666;">
					<label class="switch">
  						<input type="checkbox">
  							<span class="slider round"></span>
					</label>
				</div>
			</div>
			<div class="w3-padding w3-row" style="max-width: 800px;">
				<div class="w3-half" style="color: #666666; font-size: 140%; font-weight: 400;">Text Notices:&nbsp;</div>
				<div class="w3-half" style="color: #666666;">
					<label class="switch">
  						<input type="checkbox">
  							<span class="slider round"></span>
					</label>
				</div>
			</div>

  		<h3>Promotional Emails</h3>
			<div class="w3-padding w3-row" style="max-width: 800px;">
				<div class="w3-half" style="color: #666666; font-size: 140%; font-weight: 400;">Sales:&nbsp;</div>
				<div class="w3-half" style="color: #666666;">
					<label class="switch">
  						<input type="checkbox">
  							<span class="slider round"></span>
					</label>
				</div>
			</div>
			<div class="w3-padding w3-row" style="max-width: 800px;">
				<div class="w3-half" style="color: #666666; font-size: 140%; font-weight: 400;">New Content:&nbsp;</div>
				<div class="w3-half" style="color: #666666;">
					<label class="switch">
  						<input type="checkbox">
  							<span class="slider round"></span>
					</label>
				</div>
			</div>
		
	</div>
</div>

</div>

	<script>
	
document.addEventListener("DOMContentLoaded", function(event) { 


var acc = document.getElementsByClassName("accordion");
var panel = document.getElementsByClassName('panel');

for (var i = 0; i < acc.length; i++) {
    acc[i].onclick = function() {
        var setClasses = !this.classList.contains('active');
        setClass(acc, 'active', 'remove');
        setClass(panel, 'show', 'remove');

        if (setClasses) {
            this.classList.toggle("active");
            this.nextElementSibling.classList.toggle("show");
			//panelHeight(this);
        }
    }
}

function setClass(els, className, fnName) {
    for (var i = 0; i < els.length; i++) {
        els[i].classList[fnName](className);
    }
}

});
		
function panelHeight(panel){
	var openPanel = panel;
	var opHeight = panel.setAttribute('offsetHeight', '5000px');
	//alert(opHeight);
}
	
	</script>
<?php
}//end login else
	
include("../components/main_script.php");

?>
</body>
</html>
