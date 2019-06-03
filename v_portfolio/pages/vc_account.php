<!doctype html>
<html>

<meta charset="utf-8">
<title>Viscid Creates Account</title>
<?php

include("../header/vc_header_main.php");

?>		
<body onload="loadAvatar(); openAccordion(); noticeChecks();">

<?php

include("../header/vc_header_menus.php");

if (!isset($_SESSION['loggedin'])) {
	
?>
<div class="w3-container" style="margin-top: 150px;">
	<div id="loginAcctPg" class="w3-container" style="margin: 0 auto">
		<!-- login form 
	<form name="vcLogin" class="w3-container w3-card w3-margin-bottom w3-margin-top w3-white" method="post" action="../components/vc_authenticate.php" ng-controller="validateCtrl" novalidate>-->
	<form name="vcLogin" id="vcLogin" class="w3-container w3-card w3-margin-bottom w3-margin-top w3-white" ng-controller="validateCtrl" novalidate>
	<h3 id="loginHeader">Login or Register!</h3>
	<div id="badlogin" class="w3-theme-alertPink" style="display: none;"></div>
		<div id="regMsg" class="w3-text-theme" style="display: none;"></div>
	<p><label>Email Address</label>
	  <input onFocus="clearMsg()" class="w3-input loginreg" type="email" id="vcemail" name="vcemail" ng-model="email" required>
	  <span class="w3-text-theme-required" ng-show="vcLogin.vcemail.$dirty && vcLogin.vcemail.$invalid">
		  <span ng-show="vcLogin.vcemail.$error.required">Email is required.</span>
		  <span ng-show="vcLogin.vcemail.$error.email">Invalid email address.</span>
	  </span>
	</p>
		
	<p>
		<label>Password</label>
		<input onFocus="clearMsg()" class="w3-input loginreg" type="password" id="vcpass" name="vcpass" ng-model="vcpass" ng-minlength="6" required>
		<span class="w3-text-theme-required" ng-show="vcLogin.vcemail.$dirty && vcLogin.vcpass.$invalid">
		  <span ng-show="vcLogin.vcpass.$error.required">Email is required.</span>
			<span ng-if="!vcLogin.vcpass.$valid">Min 6 characters</span>
  		</span>
	</p>
	<p class="w3-hide confShow w3-animate-zoom" id="confirmPW">
		<label>Confirm Password</label>
		<input id="vcConfPW" class="w3-input loginreg" type="password" name="vcconfpw" ng-model="vcconfpw" required match-pass>
	  <span class="w3-text-theme-required" ng-show="vcLogin.vcconfpw.$dirty && vcLogin.vcconfpw.$invalid">
		  <span ng-show="vcLogin.vcconfpw.$error.required">Please confirm password.</span>
		  <span ng-if="!vcLogin.vcconfpw.$valid">Passwords must match.</span>
	  </span>
	</p>			
	<p class="w3-hide confShow w3-animate-zoom" id="addFirst">
		<label>First Name</label>
		<input id="vcFirst" class="w3-input loginreg" type="text" name="vcfirst" ng-model="vcfirst" required>
		<span class="w3-text-theme-required" ng-show="vcLogin.vcfirst.$dirty && vcLogin.vcfirst.$invalid">
		 	<span ng-show="vcLogin.vcfirst.$error.required">First name is required.</span>
	  </span>
	</p>

	<p class="w3-hide confShow w3-animate-zoom" id="addLast">
		<label>Last Name</label>
		<input id="vcLast" class="w3-input loginreg" type="text" name="vclast" ng-model="vclast" required>
		<span class="w3-text-theme-required" ng-show="vcLogin.vclast.$dirty && vcLogin.vclast.$invalid">
		  <span ng-show="vcLogin.vclast.$error.required">Last name is required.</span>
	  </span>
	</p>		
	<p>
		<div class="w3-row w3-center">
			<div id="loginDiv" class="loginShow w3-half w3-container w3-margin-bottom">
				<!--show if invalid - won't submit -->
				<div class="w3-block w3-button vc_boxshadow w3-light-grey" style="cursor: not-allowed !important;" ng-show="vcLogin.vcemail.$dirty && vcLogin.vcemail.$invalid || vcLogin.vcpass.$dirty && vcLogin.vcpass.$invalid">Login</div>
				<!--show if valid will submit -->
				<div class="" ng-hide="vcLogin.vcemail.$dirty && vcLogin.vcemail.$invalid || vcLogin.vcpass.$dirty && vcLogin.vcpass.$invalid">
					<div class="w3-block w3-button vc_boxshadow w3-theme-action" onClick="loginregForm('login')">Login</div>
				</div>
			</div>
			<div id="registerDiv" class="loginShow w3-half w3-container">
				<div class="w3-block w3-button vc_boxshadow w3-theme-action" onClick="yesnoReg('reg')">Register</div>
			</div>
			<div id="cancelDiv" class="confShow w3-half w3-container w3-hide" onClick="yesnoReg('cancel')">
				<div class="w3-block w3-button vc_boxshadow w3-theme-action">Cancel</div>
			</div>
			<div id="confirmDiv" class="confShow w3-half w3-container w3-hide">
				<div class="w3-block w3-button vc_boxshadow w3-grey" ng-show="vcLogin.vcemail.$dirty && vcLogin.vcemail.$invalid || vcLogin.vcPass.$dirty && vcLogin.vcPass.$invalid || vcLogin.vcconfpw.$invalid">Confirm</div>
				<div class="w3-block w3-button vc_boxshadow w3-theme-action" ng-hide="vcLogin.vcemail.$dirty && vcLogin.vcemail.$invalid || vcLogin.vcPass.$dirty && vcLogin.vcPass.$invalid || vcLogin.vcconfpw.$invalid" onClick="loginregForm('reg')">Confirm</div>
			</div>
		</div>
	</p>
</form>
	<!-- end login form -->
	</div>
</div>
<?php
	
}//end logged in IF 

else {
	
?>
	
<div class="acctAccordionContainer w3-container" style="margin-top:150px;">

<h2 class="w3-border-bottom w3-border-gray w3-opacity-min" style="width: 50%">Account</h2>

<div id="profile" class="accordion w3-block w3-border-bottom w3-border-theme w3-theme-l4 w3-left w3-padding-top">
<span class="vcicon icon-accountvc"></span>&nbsp;<span class="accountText">Profile</span></div>

<div id="Demo1" class="panel w3-container">
	<!-- begin upload avatar modal stuff -->
   <div id="avatar_modal" class="w3-modal w3-animate-opacity">
    <div id="avatar_modal_content" class="w3-modal-content w3-card w3-animate-zoom w3-center" style="width: 55%;">
	<header class="w3-container w3-theme">
		<h3>Upload Profile Image</h3>
		<span onclick="document.getElementById('avatar_modal').style.display='none'" class="w3-button w3-display-topright" style="font-size: 170%">&times;</span>
	</header>
      <div class="w3-container w3-padding w3-row" style="font-size: 120%;">		  
	<?php include("../components/uploadForm.php"); ?>
      </div>
    </div>
  </div>
	<!-- end upload avatar modal stuff -->
	<!-- begin edit avatar modal stuff -->
   <div id="edit_avatar_modal" class="w3-modal w3-animate-opacity">
    <div id="edit_avatar_modal_content" class="w3-modal-content w3-card w3-animate-zoom w3-center" style="width: 40%;">
	<header class="w3-container w3-theme">
		<h3>Edit Profile Image</h3>
		<span onclick="document.getElementById('edit_avatar_modal').style.display='none'" class="w3-button w3-display-topright" style="font-size: 170%">&times;</span>
	</header>
      <div class="w3-container w3-padding w3-row" style="font-size: 100%;">		  
	<?php include("../components/avatarEdit.php"); ?>
      </div>
    </div>
  </div>
	<!-- end edit avatar modal stuff -->
	<!-- begin delete confirm modal stuff -->
	
   <div id="delete_avatar_modal" class="w3-modal w3-animate-opacity">
    <div id="delete_avatar_modal_content" class="w3-modal-content w3-card w3-animate-zoom w3-center" style="width: 40%;">
	<header class="w3-container w3-theme">
		<h3>Delete Profile Image?</h3>
		<span onclick="document.getElementById('delete_avatar_modal').style.display='none'" class="w3-button w3-display-topright" style="font-size: 170%">&times;</span>
	</header>
      <div class="w3-bar">
			<div class="vc_button_form vc_boxshadow w3-button w3-theme-l3" style="margin-right: 4px" onclick="document.getElementById('delete_avatar_modal').style.display='none'">CANCEL</div>
		  	<a href="../components/delete_avatar.php">
				<div class="vc_button_form w3-button vc_boxshadow w3-theme-alertPink" style="margin-left: 4px">Delete</div>
			</a>
		</div>
    </div>
  </div>
	
	<!-- begin delete confirm modal stuff -->
<div class="w3-padding-24 w3-center" style="">
	<div id="avatar_box_main" class="w3-circle w3-hover-opacity" style="position: relative;">
			<!--<img id="acct_avatar" class="acct_profile_img" src="../Accounts/Images/profileImg.jpg" />-->
		<div id="editAv" class="w3-white w3-padding-24" onMouseOver="this.style.opacity='0.6'" onMouseOut="this.style.opacity='0'" onClick="w3_open('edit_avatar_modal','100%')">
			<!--<span class="vcicon icon-editvc"><span class="path1"></span><span class="path2"></span></span>-->
			<span class="w3-text-dark-grey" style="font-weight: 800">Edit Image</span><br />
			<span class="vcicon icon-Icon_cameravc" style="font-size: 250%"></span>
		</div>	
	</div>
	

	<div class="w3-padding">
		<div class="w3-bar">
			<div class="vc_button_form vc_boxshadow w3-button w3-theme-l3" style="margin-right: 4px" onClick="w3_open('avatar_modal','100%')">Upload</div>
			<div class="vc_button_form w3-button vc_boxshadow w3-theme-alertPink" style="margin-left: 4px" onClick="w3_open('delete_avatar_modal','100%')">Delete</div>
		</div>
		<div style="font-size: 110%; font-weight: 800;" id="dispUser">Username:&nbsp;[username]</div>
	</div>
</div>
<form class="w3-container w3-card w3-margin-bottom">
	<h3>Update Personal Info</h3>
	<p>
		<label>First Name</label>
		<input class="w3-input profileupdate" type="text" name="acct_first" id="acct_first"></p>
	<p>
		<label>Last Name</label>
		<input class="w3-input profileupdate" type="text" name="acct_last" id="acct_last"></p>
	<p>
		<label>Email</label>
		<input class="w3-input profileupdate" type="text" name="acct_email" id="acct_email"></p>
	<p>
		<div class="w3-block w3-button vc_boxshadow w3-theme-action" onclick="profileUpdateForm('update')">Update</div></p>
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

<div id="billing" class="accordion w3-block w3-border-bottom w3-border-theme w3-theme-l4 w3-left">
<span class="vcicon icon-billingvc"></span>&nbsp;<span class="accountText">Billing</span></div>

<div id="Demo2" class="panel w3-container">
	
	<!-- begin method detail modal stuff -->
   <div id="method_modal" class="w3-modal w3-animate-opacity">
    <div id="method_modal_content" class="w3-modal-content w3-card w3-animate-zoom">
	<header class="w3-container w3-theme">
		<h2 id="methodHeader">Edit Payment Method</h2>
		<span onclick="document.getElementById('method_modal').style.display='none'" class="w3-button w3-display-topright" style="font-size: 200%">&times;</span>
	</header>
      <form id="methodForm" method="post" action="../components/query_update_method.php" class="w3-container w3-card w3-margin-bottom" style="font-size: 110%;">
		<label>Nickname</label>
			<input id="m_nickname" class="w3-row w3-input" type="text" name="m_nickname">
		<label>Name on Card</label>
   			<input id="m_name" class="w3-row w3-input" type="text" name="m_name">
		<label>Expires</label>
			<input id="m_expires" class="w3-row w3-input" type="text" name="m_expires">
   		<label>Billing Zipcode</label>
		  	<input id="m_zip" class="w3-row w3-input" type="text" name="m_zip">
		<input id="m_id" class="w3-row w3-input" type="text" name="mid" style="display: none;">
		<div class="w3-row w3-margin-bottom w3-padding-16">
		<div class="w3-third w3-container w3-margin-bottom"><button type="submit" id="update_method" class="w3-block w3-button vc_boxshadow w3-theme-action">Save</button></div>
			</form>
		<div class="w3-third w3-container w3-margin-bottom"><span id="remove_method" class="w3-block w3-button vc_boxshadow w3-theme-alertPink" onclick="removeMethod(this.value)">REMOVE</span></div>
		<div class="w3-third w3-container w3-margin-bottom"><span id="cancel_edit_method" class="w3-block w3-button vc_boxshadow w3-theme-alertPink" onclick="document.getElementById('method_modal').style.display='none'">CANCEL</span></div>
		</div>

    </div>
  </div>
  		
	<!-- end method detail modal stuff -->

	<!-- begin delete method confirm modal stuff -->
	
   <div id="delete_method_modal" class="w3-modal w3-animate-opacity">
    <div id="delete_method_modal_content" class="w3-modal-content w3-card w3-animate-zoom w3-center" style="width: 40%;">
	<header class="w3-container w3-theme">
		<h3>Remove Payment Method?</h3>
		<span onclick="document.getElementById('delete_method_modal').style.display='none'" class="w3-button w3-display-topright" style="font-size: 170%">&times;</span>
	</header>
      <div class="w3-bar">
			<div class="vc_button_form vc_boxshadow w3-button w3-theme-l3" style="margin-right: 4px" onclick="document.getElementById('delete_method_modal').style.display='none'">CANCEL</div>
				<div class="vc_button_form w3-button vc_boxshadow w3-theme-alertPink" style="margin-left: 4px">Delete</div>
		</div>
    </div>
  </div>
	
	<!-- enddelete method confirm modal stuff -->
	
	<div class="w3-left w3-card w3-padding w3-margin-bottom" style="width: 100%" ng-app="myApp" ng-controller="paymethodsCtrl">
  		<h3>Payment Methods</h3>
		<div class="w3-padding w3-row w3-hover-opacity" style="max-width: 800px; cursor: pointer" ng-repeat="x in mid">
			
				<div class="w3-padding" ng-hide="{{ x.nickname }} == ''">
					<span class="vcicon icon-editvc"><span class="path1"></span><span class="path2"></span></span>&nbsp;
					<a href="#" id="mid_{{ x.mid }}" class="iconlink w3-hover-opacity" onclick="getID(this.id)" style="color: #666666;">{{ x.nickname }}</a>
				</div>
			
		</div>
			<div id="newMethod_0" class="w3-padding w3-hover-opacity" onclick="getID(this.id)" style="cursor: pointer"><span class="vcicon icon-addvc"></span>&nbsp;Add Payment Method</div>
		
	</div>
</div>

<div id="orders" class="accordion w3-block w3-border-bottom w3-border-theme w3-theme-l4 w3-left">
<span class="vcicon icon-ordersvc"></span>&nbsp;<span class="accountText">Orders</span></div>

<div id="Demo3" class="panel w3-container">
	<!-- begin order detail modal stuff -->
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

  		
	<!-- end order detail modal stuff -->
	<div class="w3-left w3-card w3-padding w3-margin-bottom" style="width: 100%" ng-app="myApp" ng-controller="myordersCtrl">
  		<h3>Orders</h3>
			<div class="w3-padding w3-row w3-hover-opacity" style="max-width: 800px; cursor: pointer" ng-repeat="x in oid">
				<a href="#" id="oid_{{ x.oid }}" onclick="getID(this.id)" ng-hide="{{ x.oid }} == ''">
				<div class="w3-third" style="color: #666666;">
					<span class="vcicon icon-viewvc"></span>&nbsp;{{ x.title }}
				</div>
				<div class="w3-third" style="color: #666666;">{{ x.oid }}</div>
				<div class="w3-third" style="color: #666666;">{{ x.date_created }}</div>
				</a>
				
			</div>
		
	</div>
	<div class="w3-left w3-card w3-padding w3-margin-bottom" id="no_orders" style="display: none; width: 100%">No orders yet! What are you waiting for?</div>
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
	  <div class="w3-row w3-third"><h3>Order Notifications</h3></div><div class="w3-row w3-twothird w3-text-theme"><span id="afterCheck" class=" w3-light-grey" style="opacity: 0; font-size: 85%;">Preference Updated</span></div>
	  		<div class="w3-padding w3-row" style="max-width: 800px;">
				<div class="w3-half" style="color: #666666; font-size: 140%; font-weight: 400;">Email Notices:&nbsp;</div>
				<div class="w3-half" style="color: #666666;">
					<label class="switch">
  						<input id="email_notices" class="noticeChecks" name="email_notices" type="checkbox" onChange="toggleSetting( this.id )">
  							<span class="tSlider round"></span>
					</label>
				</div>
			</div>
			<div class="w3-padding w3-row" style="max-width: 800px;">
				<div class="w3-half" style="color: #666666; font-size: 140%; font-weight: 400;">Text Notices:&nbsp;</div>
				<div class="w3-half" style="color: #666666;">
					<label class="switch">
  						<input id="text_notices" class="noticeChecks" name="text_notices" value="yes" type="checkbox" onChange="toggleSetting( this.id )">
  							<span class="tSlider round"></span>
					</label>
				</div>
			</div>

  		<h3>Promotional Emails</h3>
			<div class="w3-padding w3-row" style="max-width: 800px;">
				<div class="w3-half" style="color: #666666; font-size: 140%; font-weight: 400;">Sales:&nbsp;</div>
				<div class="w3-half" style="color: #666666;">
					<label class="switch">
  						<input id="email_sales" class="noticeChecks" name="email_sales" value="yes" type="checkbox" onChange="toggleSetting( this.id )">
  							<span class="tSlider round"></span>
					</label>
				</div>
			</div>
			<div class="w3-padding w3-row" style="max-width: 800px;">
				<div class="w3-half" style="color: #666666; font-size: 140%; font-weight: 400;">New Content:&nbsp;</div>
				<div class="w3-half" style="color: #666666;">
					<label class="switch">
  						<input id="email_content" class="noticeChecks" name="email_content" value="yes" type="checkbox" onChange="toggleSetting( this.id )">
  							<span class="tSlider round"></span>
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
