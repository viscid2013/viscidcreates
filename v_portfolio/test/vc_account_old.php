<!doctype html>
<html>

<meta charset="utf-8">
<title>Viscid Creates Account</title>
<?php

include("../header/vc_header_main.php");

?>		
<body>

<?php

include("../header/vc_header_menus.php");

?>
	
<div class="acctAccordionContainer w3-container" style="margin-top:150px;">

<h2 class="w3-border-bottom w3-border-gray w3-opacity-min" style="width: 50%">Account</h2>

<div class="accordion w3-block w3-border-bottom w3-border-theme w3-theme-l4 w3-left w3-padding-top">
<span class="vcicon icon-accountvc"></span>&nbsp;<span class="accountText">Profile</span></div>

<div id="Demo1" class="panel w3-container">
<div class="w3-padding-24 w3-center" style="width: 85%">
	<div class="w3-padding">
			<img class="acct_profile_img w3-circle w3-hover-opacity" src="../Accounts/Images/profileImg.jpg" />
	</div>
	<div class="w3-padding">
		<div class="w3-bar">
			<div class="vc_button_form vc_boxshadow w3-button w3-theme-l3" style="margin-right: 4px">Upload</div>
			<div class="vc_button_form w3-button vc_boxshadow w3-theme-alertPink" style="margin-left: 4px">Delete</div>
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
<form class="w3-container w3-card">
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

<div id="Demo2" class="panel w3-center w3-container">
  <p>I am typing some more text in here in the hopes of getting to see a bit more of a tall open accordion section which will give me a better idea of the overall design and yada yada and so on and so forth and is this enough yet I sure hope so thanks I think I can stop typing now.</p>
</div>

<div class="accordion w3-block w3-border-bottom w3-border-theme w3-theme-l4 w3-left">
<span class="vcicon icon-ordersvc"></span>&nbsp;<span class="accountText">Orders</span></div>

<div id="Demo3" class="panel w3-container w3-center">
  <p>I am typing some more text in here in the hopes of getting to see a bit more of a tall open accordion section which will give me a better idea of the overall design and yada yada and so on and so forth and is this enough yet I sure hope so thanks I think I can stop typing now.</p>
</div>
	
<div class="accordion w3-block w3-border-bottom w3-border-theme w3-theme-l4 w3-left">
<span class="vcicon icon-favoritesvc"></span>&nbsp;<span class="accountText">Favorites</span></div>

<div id="Demo3" class="panel w3-container w3-center">
  <p>I am typing some more text in here in the hopes of getting to see a bit more of a tall open accordion section which will give me a better idea of the overall design and yada yada and so on and so forth and is this enough yet I sure hope so thanks I think I can stop typing now.</p>
</div>
	
<div class="accordion w3-block w3-border-bottom w3-border-theme w3-theme-l4 w3-left">
<span class="vcicon icon-settingsvc"></span>&nbsp;<span class="accountText">Settings</span></div>

<div id="Demo3" class="panel w3-container w3-center">
  <p>I am typing some more text in here in the hopes of getting to see a bit more of a tall open accordion section which will give me a better idea of the overall design and yada yada and so on and so forth and is this enough yet I sure hope so thanks I think I can stop typing now.</p>
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
include("../components/main_script.php");
?>
</body>
</html>
