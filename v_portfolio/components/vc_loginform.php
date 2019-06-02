	<form name="vcLogin" class="w3-container w3-card w3-margin-bottom w3-margin-top w3-white" method="post" action="../components/vc_authenticate.php" ng-app="myAppl" ng-controller="validateCtrl" novalidate>
	<h3 id="loginHeader">Login or Register!</h3>
	
	<p><label>Email Address</label>
	  <input class="w3-input loginreg" type="email" id="vcemail" name="vcemail" ng-model="email" required>
	  <span class="w3-text-theme-required" ng-show="vcLogin.vcemail.$dirty && vcLogin.vcemail.$invalid">
		  <span ng-show="vcLogin.vcemail.$error.required">Email is required.</span>
		  <span ng-show="vcLogin.vcemail.$error.email">Invalid email address.</span>
	  </span>
	</p>
		
	<p>
		<label>Password</label>
		<input class="w3-input loginreg" type="password" id="vcpass" name="vcpass" ng-model="password" ng-minlength="6" required>
		<span class="w3-text-theme-required" ng-show="vcLogin.vcPass.$dirty && vcLogin.vcPass.$invalid">
			<span ng-show="vcLogin.vcPass.$error.required">Password is required.</span>
			<span ng-if="!vcLogin.vcPass.$valid">Min 6 characters</span>
  		</span>
	</p>
	<p class="w3-hide confShow w3-animate-zoom" id="confirmPW">
		<label>Confirm Password</label>
		<input id="vcConfPW" class="w3-input loginreg" type="password" name="vcconfpw" ng-model="vcconfpw" match-pass>
		<span class="w3-text-theme-required" ng-show="vcLogin.vcconfpw.$error.required">Password is required.</span>
		<span class="w3-text-theme-required" ng-show="vcLogin.vcconfpw.$dirty && vcLogin.vcconfpw.$invalid">Passwords must match</span>
	</p>			
	<p class="w3-hide confShow w3-animate-zoom" id="addFirst">
		<label>First Name</label>
		<input id="vcFirst" class="w3-input loginreg" type="text" name="vcfirst" ng-model="vcfirst">
		<span class="w3-text-theme-required" ng-show="vcLogin.vcfirst.$dirty && vcLogin.vcfirst.$invalid">
		 	<span ng-show="vcLogin.vcfirst.$error.required">First name is required.</span>
	  </span>
	</p>

	<p class="w3-hide confShow w3-animate-zoom" id="addLast">
		<label>Last Name</label>
		<input id="vcLast" class="w3-input loginreg" type="text" name="vclast" ng-model="vclast">
		<span class="w3-text-theme-required" ng-show="vcLogin.vclast.$dirty && vcLogin.vclast.$invalid">
		  <span ng-show="vcLogin.vclast.$error.required">Last name is required.</span>
	  </span>
	</p>		
	<p>
		<div class="w3-row w3-center">
			<div id="loginDiv" class="loginShow w3-half w3-container w3-margin-bottom">
				<!--<div class="w3-block w3-button vc_boxshadow w3-theme-grey" ng-show="vcLogin.vcemail.$dirty && vcLogin.vcemail.$invalid || vcLogin.vcPass.$dirty && vcLogin.vcPass.$invalid">Login</div>-->
				<input type="submit" value="Login" class="w3-block w3-button vc_boxshadow w3-theme-action"/>
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
<script>
var appl = angular.module('myAppl', []);
appl.controller('validateCtrl', function($scope) {
	$scope.vcPass = '';
	$scope.vcemail = '';
	$scope.vcconfpw = '';
	$scope.vcfirst = '';
	$scope.vclast = '';
});
</script>
