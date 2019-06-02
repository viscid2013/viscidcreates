var app = angular.module('myApp', []);
app.controller('inventoryCtrl', function($scope, $http) {
  $http.get("../components/query_inventory.php")
  .then(function (response) {$scope.title = response.data.inventory;});
	});
/* end inventoryCtrl controller */
	
app.controller('myfavsCtrl', function($scope, $http) {
  $http.get("../components/query_inventory.php")
  .then(function (response) {$scope.title = response.data.inventory;});
	});
	
/* end myfavsCtrl controller */
	
app.controller('myordersCtrl', function($scope, $http) {
  $http.get("../components/query_orders.php")
  .then(function (response) {$scope.oid = response.data.orders;});
	});
	
/* end myfavsCtrl controller */

app.controller('validateCtrl', function($scope) {
	$scope.vcPass = '';
	$scope.vcemail = '';
	$scope.vcconfpw = '';
	$scope.vcFirst = '';
	$scope.vcLast = '';
});
	
app.directive('matchPass', function() {
  return {
    require: 'ngModel',
    link: function(scope, element, attr, mCtrl) {
      function myValidation(value) {
		  var pw1 = document.getElementById("vcPass").value;
        if (value == pw1) {
          mCtrl.$setValidity('match', true);
        } else {
          mCtrl.$setValidity('match', false);
        }
        return value;
      }
      mCtrl.$parsers.push(myValidation);
    }
  };
});

	
app.controller('pageCtrl', function($scope) {
 

var getUrlVars = function() {
    var vars = {};
    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
        vars[key] = value;
    });
    return vars;
}

//$scope.vc_setDefaultPage = function(){
	var vc_default = getUrlParam('vcpage','vc_photos_main.html');
	//return vc_default;
	
//}

function getUrlParam(parameter, vc_default){
		//alert(window.location.href.indexOf(parameter))
    var urlparameter = vc_default;
    if(window.location.href.indexOf(parameter) > -1){
		urlparameter = getUrlVars()[parameter];
        }
    return urlparameter;
}
	

	
$scope.load_vcpage = function(){
	
	if(window.location.href.indexOf("vcpage") > -1){
	var currPage = getUrlVars()["vcpage"];
	}
	else{
		updateURL("vc_photos_main.html");
	}
	//alert(currPage);
	return currPage;
	
}
	
	});
/* end pageCtrl controller */

function updateURL(newpage){
	var nowpage1 = window.location.href;
	if(nowpage1.indexOf("?") > -1){
		var nowpage2 = nowpage1.split("?");
		var nowpage = nowpage2[0];
		var gotopage = nowpage + "?vcpage=" + newpage;
	   }
	else{
		var gotopage = nowpage1 + "?vcpage=" + newpage;
	}

	window.location.assign(gotopage);
}


// Open and close sidebar
function w3_open(menuid,size) {
  document.getElementById(menuid).style.width = size;
  document.getElementById(menuid).style.display = "block";
  document.getElementById("transBackMain").style.display = "block";
  document.getElementById("transBackMain").style.width = "100%";
}

function w3_close(menuid) {
  document.getElementById(menuid).style.display = "none";
  document.getElementById("transBackMain").style.display = "none";
	if( menuid == 'loginSidebar' ){
	   cancelReg();
	   }
	 
}
	function filter_open(){
		if( document.getElementById("filtersMobile").style.display == "none" ){
		document.getElementById("filtersMobile").style.display = "block";
		}//end if
		else if( document.getElementById("filtersMobile").style.display == "block" ){
				document.getElementById("filtersMobile").style.display = "none";
		}//end else if
	}//end filter_open


function acctAccordion(id) {
  var x = document.getElementById(id);
  var y = document.getElementsByClassName("acct_accordion");
	var i;
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
    for( i = 0; i < y.length; i++ ){
    	if (y.id != x.id){
        	y.className = y.className.replace(" w3-show", "");
        }
    }
  } else { 
    x.className = x.className.replace(" w3-show", "");
  }
}	
	
// Get the modal
var modal = document.getElementById('orders_modal');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

function yesnoReg(which){
	var conf = document.getElementsByClassName("confShow");
	var login = document.getElementsByClassName("loginShow");
	var confPW = document.getElementById("vcConfPW");
	
	if( which == 'reg' ){
		confPW.setAttribute('required','');
	}
	
	for( var l=0; l < login.length; l++ ){
		var ll = login[l];
		if( which == 'reg' ){
	   		ll.classList.add("w3-hide");
	  	}
		else if(  which == 'cancel'  ){
			ll.classList.remove("w3-hide");	
		}
		
	}
	for( var c=0; c <conf.length; c++ ){
		var cc = conf[c];
		if( which == 'reg' ){
		cc.classList.remove("w3-hide");
		}
		else if( which == 'cancel' ){
		cc.classList.add("w3-hide");		
		}
	}
}
	
function cancelReg(){
	var conf = document.getElementsByClassName("confShow");
	var login = document.getElementsByClassName("loginShow");

	for( var l=0; l < login.length; l++ ){
		var ll = login[l];
	   		ll.classList.remove("w3-hide");
	}
	for( var c=0; c <conf.length; c++ ){
		var cc = conf[c];
		cc.classList.add("w3-hide");

	}
	
}

function regForm(){
	var formEls = document.getElementsByClassName("loginreg");
	var formObj = {};
	var objCont = '{';
	for( var f=0; f < formEls.length; f++ ){
		if( f < 2 ){  
			objCont += '"' + formEls[f].id + '":"' + formEls[f].value + '",';
		   }
		else{
			objCont += '"' + formEls[f].id + '":"' + formEls[f].value + '"}';	
		}
		
		//alert(formEls[f].value);
	}
	formObj = JSON.parse(objCont);
	//formObj = objCont;
	alert(formObj.vcEmail);
	
	postAjax('../components/query_account_reg.php', formObj, function(data){ console.log(data); });
	
}

function postAjax(url, data, success) {
    var params = typeof data == 'string' ? data : Object.keys(data).map(
            function(k){ return encodeURIComponent(k) + '=' + encodeURIComponent(data[k]) }
        ).join('&');

    var xhr = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
    xhr.open('POST', url);
    xhr.onreadystatechange = function() {
        if (xhr.readyState>3 && xhr.status==200) { success(xhr.responseText); }
    };
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send(params);
    return xhr;
}
	

function getID(rawid){
	var tid = rawid.split("_");
	var tid = tid[1];
	orderDetails(tid);
}

function orderDetails(oid){
	var order_id = oid;
	var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
			var theOrder = JSON.parse(this.responseText);
      		//document.getElementById("orders_modal_content").innerHTML = theOrder.oid;
		//alert(theOrder.oid);
		
		var dateNegLen = -Math.abs(theOrder.date_created.length);
		var shortDate = theOrder.date_created.slice( dateNegLen, -8 ) ;
		var dateForOrder = shortDate.replace(/-/g,"").trim();
		
		
		document.getElementById("order_id").innerHTML = "Order Number: " + dateForOrder + "-" + theOrder.oid;
		document.getElementById("order_title").innerHTML = "Title: " + theOrder.title;
		document.getElementById("order_date").innerHTML = "Date Ordered: " + shortDate;
		document.getElementById("order_status").innerHTML = "Order Status: " + theOrder.status.replace("_"," ");
		document.getElementById("order_tracking").innerHTML = "Tracking Number: " + theOrder.tracking_no;
		document.getElementById("order_paid").innerHTML = "Paid With: " + theOrder.pay_method;
		document.getElementById("order_total").innerHTML = "Order Total: $" + ( parseFloat(theOrder.price) + parseFloat(theOrder.tax) );
		document.getElementById("order_print").value = "print_" + theOrder.oid;
		document.getElementById("order_ask").value = "ask_" + theOrder.oid;
		
    	}
  	};
	xhttp.open("GET", "../components/query_order_detail.php?oid=" + order_id, true);
	xhttp.send();
	
	document.getElementById('orders_modal').style.display='block';
	
}
	
function printReceipt(orderNo){
	alert(orderNo);
}
	
function openOrderQuery(orderNo){
	alert(orderNo);
}
	