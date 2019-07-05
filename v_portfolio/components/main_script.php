<script>
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
  .then(function (response) {
  		if( response.data == "" ){
		   document.getElementById("no_orders").style.display = "block";
		   }
	  else{
		 $scope.oid = response.data.orders; 
	  }
  });
	});
	
//orders controller backup
/*app.controller('myordersCtrl', function($scope, $http) {
  $http.get("../components/query_orders.php")
  .then(function (response) {$scope.oid = response.data.orders;});
	});*/


app.controller('paymethodsCtrl', function($scope, $http) {
  $http.get("../components/query_methods.php")
  .then(function (response) {$scope.mid = response.data.methods;});
	});
	
/* end myfavsCtrl controller */

app.controller('validateCtrl', function($scope) {
	$scope.vcpass = '';
	$scope.vcemail = '';
	$scope.vcconfpw = '';
	$scope.vcfirst = '';
	$scope.vclast = '';
});
	
	/* end validateCtrl controller */
	
app.directive('matchPass', function() {
  return {
    require: 'ngModel',
    link: function(scope, element, attr, mCtrl) {
      function myValidation(value) {
		  var pw1 = document.getElementById("vcpass").value;
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

function getUrlVars() {
    var vars = {};
    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
        vars[key] = value;
    });
    return vars;
}
	
function openAccordion(){

	if(window.location.href.indexOf("?") > -1){
		var accord = getUrlVars()["accordion"];
		document.getElementById(accord).click();
	}

}
	
	
// Open and close sidebars and modals
function w3_open(menuid,size) {
  document.getElementById(menuid).style.width = size;
  document.getElementById(menuid).style.display = "block";
if( menuid !== 'avatar_modal' && menuid !== 'edit_avatar_modal' && menuid !== 'delete_avatar_modal' && menuid != 'cart_modal' ) {
  document.getElementById("transBackMain").style.display = "block";
  document.getElementById("transBackMain").style.width = "100%";
}

	/*if( menuid == 'loginSidebar' ){
	   loadLogin('loginFormSidebar');
	   }*/
}

function w3_close(menuid) {
  document.getElementById(menuid).style.display = "none";
  document.getElementById("transBackMain").style.display = "none";
	if( menuid == 'loginSidebar' ){
	   cancelReg();
	   }
	 
}
	
function loadLogin(where) {
	var target = where;
	if( document.body.contains(document.getElementById(target)) ){
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
     document.getElementById(target).innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "../components/vc_loginform.php", true);
  xhttp.send();
}//end if element exists
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
	
function loadAvatar() {
	//alert("hello?");
	if( document.body.contains(document.getElementById('avatar_box_main')) ){
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
		var acctObj = JSON.parse(this.responseText);
		if(acctObj.avatar_link == null || acctObj.avatar_link == "" || acctObj.avatar_link == "NULL"){
     		document.getElementById('avatar_box_main').style.backgroundImage = "url('../branding_icons/blankUser.svg')";
			document.getElementById('avatar_box_main').style.backgroundPosition = "center";
			document.getElementById('avatar_box_main').style.backgroundSize = "100%";
			document.getElementById('dispUser').innerHTML = acctObj.first + " " + acctObj.last;		}
		else{
			document.getElementById('avatar_box_main').style.backgroundImage = "url('" + acctObj.avatar_link + "')";
			document.getElementById('avatar_box_main').style.backgroundPosition = acctObj.bgPos;
			document.getElementById('avatar_box_main').style.backgroundSize = acctObj.bgSize + "%";
		}
		document.getElementById('dispUser').innerHTML = acctObj.first + " " + acctObj.last;
		document.getElementById('acct_first').value = acctObj.first;
		document.getElementById('acct_last').value = acctObj.last;
		document.getElementById('acct_email').value = acctObj.email;
		document.getElementById('address1').value = acctObj.address1;
		document.getElementById('address2').value = acctObj.address2;
		document.getElementById('city').value = acctObj.city;
		document.getElementById('state').value = acctObj.state;
		document.getElementById('zip').value = acctObj.zip;
		
    }
  };
  xhttp.open("GET", "../components/query_profile.php", true);
  xhttp.send();
}//end if element exists
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
	var vcFirst = document.getElementById("vcFirst");
	var vcLast = document.getElementById("vcLast");
	
	if( which == 'reg' ){
		confPW.setAttribute('required','required');
		vcFirst.setAttribute('required','required');
		vcLast.setAttribute('required','required');
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
		cc.removeAttribute('required');
	}
	
}

function loginregForm(which){
	var whatNext = which;
	var formEls = document.getElementsByClassName("loginreg");
	var formObj = {};
	var objCont = '{';
	for( var f=0; f < formEls.length; f++ ){
		if( f < (formEls.length - 1) ){  
			objCont += '"' + formEls[f].id + '":"' + formEls[f].value + '",';
		   }
		else{
			objCont += '"' + formEls[f].id + '":"' + formEls[f].value + '"}';	
		}
		
		//alert(formEls[f].value);
	}
	formObj = JSON.parse(objCont);
	//formObj = objCont;
	//alert(objCont);
	
	if( whatNext == 'login' ){
	   postAjax('../components/vc_authenticate.php', formObj, function(data){ console.log(data); });
	   }
	else if ( whatNext == 'reg' ){
		postAjax('../components/query_account_reg.php', formObj, function(data){ console.log(data); });
	}//end if

}
	
function clearMsg(){
	var bl = document.getElementById("badlogin");	
	var rm = document.getElementById("regMsg");
	
	if( bl.style.display != "none" ){
	   bl.style.display = "none";
	   }
	if( rm.style.display != "none" ){
	   rm.style.display = "none";
	   }
	
}
	
function profileUpdateForm(which){
	var whatNext = which;
	var formEls = document.getElementsByClassName("profileupdate");
	var formObj = {};
	var objCont = '{';
	for( var f=0; f < formEls.length; f++ ){
		if( f < (formEls.length - 1) ){  
			objCont += '"' + formEls[f].id + '":"' + formEls[f].value + '",';
		   }
		else{
			objCont += '"' + formEls[f].id + '":"' + formEls[f].value + '"}';	
		}
		
		//alert(formEls[f].value);
	}
	formObj = JSON.parse(objCont);

		postAjax('../components/query_update_profile.php', formObj, function(data){ console.log(data); });


}

function addToCart(aid, mVd){
	var add = aid;
	var mvd =  mVd;
	if(mvd == "mobile"){
	   	var size = document.getElementById("mSize_"+add).value;
		var acm = document.getElementById("mAddToCartMsg_" + aid);
	   }
	else{
		var size = document.getElementById("size_"+add).value;
		var acm = document.getElementById("addToCartMsg_" + aid);
	}
	
	if(size == '' || size == undefined){
	   //alert("Please select a size");
		var msg = "Please select a size"
		blankEntryMsg( acm, msg );
	   }
	else{
		var cartObj = '{"addId":"' + add + '","size":"' + size +'"}';
		//alert( cartObj );
		cartObj = JSON.parse(cartObj);
	postAjax('../components/create_cart_session.php', cartObj, function(data){ console.log(data); });
	showAndShrink("addToCartIndicator");
	}
	
}
	
function blankEntryMsg( msgDiv, msg ) {
		var md = msgDiv;
		var msg = msg;
		md.innerHTML = msg;
		md.style.display = "block";
		md.style.opacity = 1;
		
	  var opac = 1;

		var id = setInterval(op, 75);

		function op() {
		  if (md.style.opacity <= 0) {
			  //alert("zero o!");
			  md.style.display = "none";
			clearInterval(id);
		  } else {
			  //alert( "hey hey" );
			opac -= 0.02;
			 md.style.opacity = opac;
		  }
		}
	
}
	
	
function showAndShrink(el){
	var elem = document.getElementById(el); 
	elem.style.display = 'block';
  	var sSize = 100;
  	var id = setInterval(frame, 1);
  	function frame() {
    	if (sSize == 1) {
      		clearInterval(id);
			elem.style.display = 'none';
			elem.style.height = '100%'; 
      		elem.style.width = '100%';  
    	} else {
      		sSize--; 
      	elem.style.height = sSize + '%'; 
      	elem.style.width = sSize + '%'; 
    	}
  	}
}

	
function loadPage(url, cFunction) {
	
  var xhttp;
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      cFunction(this);
    }
  };
  xhttp.open("GET", url, true);
  xhttp.send();
	
}
	
function loadPage2(url, cFunction, a3, loc) {
	var aaa = a3;
	var loc = loc;
  var xhttp;
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      cFunction(this, aaa, loc);
    }
  };
  xhttp.open("GET", url, true);
  xhttp.send();
	
}

function execSearch(xhttp){
		var sContent = xhttp.responseText;
	document.getElementById("myGrid").innerHTML = sContent;
}

	
function filterSearch(){
	var fvars;
	fvars = "";
	var fchecks = document.getElementsByClassName("sizeFilter");
	var fLen = fchecks.length;
	var i;
	var fArray = [];
	for( i = 0; i < fLen; i++ ){
		if( fchecks[i].checked ) {
			fArray.push(fchecks[i].value);
		}
	}
	//alert(fArray);
	
	var search = document.getElementById("headerSearch").value;
	
	
	if( fLen > 0){
		fvars += fArray.join("_");
	   }
	else if( fLen < 1 ){
		fvars = "";
		}

		var urlApp = '?search=' + search + "&filters=" + fvars;

	
	//alert(urlApp);
	loadPage('../components/query_inventory.php' + urlApp, execSearch);
	
}

function addFav(xhttp){
		var favInfo = xhttp.responseText;
	if( favInfo === "false" ){
	   alert("Please log in to fav a pic!");
	   }
	else{
	var favInfoA = favInfo.split("_");
	var favNum = favInfoA[0];
	var favId = favInfoA[1];

	document.getElementById("favs_" + favId).innerHTML = favNum;
	document.getElementById("mFavs_" + favId).innerHTML = favNum;
	}	
}
	
function fetchComments(loc,iid){
	var lOc = loc;
	var iId = iid;

		loadPage2('../components/query_fetch_comments.php?iid=' + iId + '&loc=' + lOc, parseComments, iId, lOc);	
}


function commentCount( xhttp, cid ){
	var cid = cid;
	var cc = xhttp.responseText;
	document.getElementById("cNumS_" + cid).innerHTML = cc;
	document.getElementById("cNum_" + cid).innerHTML = cc;
}

function entryLimit( entry, wordLimit, cid ){
	var entry = document.getElementById(entry).value;
	var limit = Number(wordLimit);
	var cid = cid;
	
	if( entry.length > limit ){
	   	var msgDiv = document.getElementById("commentMsg_" + cid);
		msgDiv.innerHTML = entry.length + "/" + limit;
		msgDiv.style.display = "block";
	   }
	else{
		msgDiv.style.display = "none";
	}
	
}
	
function parseComments(xhttp,iid, loc){
	var cInfo = xhttp.responseText;
	var iid = iid;
	var loc = loc;
	//alert(cInfo.comments[0].comment);

	   	
	if(loc === 'm'){
	   var cMain = document.getElementById("viewCommentsM_" + iid );
		cMain.innerHTML = cInfo;
		var under = document.getElementById("behindSlidesM_" + iid );
		var inner = document.getElementById("vcImageTile_" + iid);
		var innerH = inner.clientHeight;
		//alert(innerH);
		under.style.height = innerH + "px";
		//cMain.style.height = innerH + "px";
		under.style.display = "block";
		cMain.style.display = "block";
	   }
	else if(loc === 's'){
	   var cSlides = document.getElementById("viewCommentsS_" + iid );
		cSlides.innerHTML = cInfo;
		var under = document.getElementById("behindSlides_" + iid );
		under.style.display = "block";
		cSlides.style.display = "block";
	   }
		
	//fetch viewComments class to hide if id no match
	var commClass = document.getElementsByClassName("viewComments");
	
	for( var c = 0; c < commClass.length; c++ ){
		if( commClass[c].id !== "viewCommentsM_" + iid && commClass[c].id !== "viewCommentsS_" + iid ){
		   commClass[c].style.display = "none";
		   }
	}
	
		var shareClass = document.getElementsByClassName("viewShare");
	
	for( var s = 0; s < shareClass.length; s++ ){
		   shareClass[s].style.display = "none";
	}
}
	
function addComment(addId, loc) {
	var loc = loc;
	var aidA = addId;
	var aidB = aidA.split("_");
	var aid = aidB[1];
	loadPage2('../components/commentForm.php?c_iid=' + aid + "&loc=" + loc, enterComment, aid, loc);
}

function enterComment(xhttp, aid, loc) {
	//alert(xhttp.responseText);
	var loc = loc;
	//var enterDiv = document.getElementById("commentDiv_" + aid);
	var enterDiv = document.getElementById("commFormContainer_" + aid);
	var buttDiv = document.getElementById("commentButton_" + aid);
	enterDiv.innerHTML = xhttp.responseText;
	var commText = document.getElementById("comment");
	buttDiv.style.display = "none";
	commText.focus();
	
}
	
	
function postComment(cId,lOc){
	var cid = cId;
	var loc = lOc;
	if( document.getElementById("comment").value === "" ) {
	   //alert("You forgot to enter a comment!");
		var msgDiv = document.getElementById("commentMsg_" + cid);
		var msg = "You forgot to type your comment!";
		blankEntryMsg( msgDiv, msg );
	   }
	else{
	var formEls = document.getElementsByClassName("commClass_" + cid);
	var formObj = {};
	var objCont = '{';
	for( var f=0; f < formEls.length; f++ ){
		if( f < (formEls.length - 1) ){  
			objCont += '"' + formEls[f].id + '":"' + formEls[f].value + '",';
		   }
		else{
			objCont += '"' + formEls[f].id + '":"' + formEls[f].value + '"}';	
		}
		
		//alert(formEls[f].value);
	}
	//alert(objCont);
	formObj = JSON.parse(objCont);

		postAjax('../components/query_add_comment.php', formObj, function(data){ console.log(data); });
		
	}//end else comment not blank
}
	
function openShare( loc, sid, iid ){
	var sid = sid;
	var loc = loc;
	var iid = iid;
	
	loadPage2('../components/query_image_url.php?iid=' + sid + "&loc=" + loc + "&iid=" + iid, showShare, sid, loc);
	//window.open('../components/query_image_url.php?iid=' + sid + "&loc=" + loc + "&iid=" + iid, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=500,left=500,width=500,height=500");
}
	
function showShare( xhttp, sid, loc){
	var img = xhttp.responseText;
	var loc = loc;
	var sid = sid;
	var iid = iid;

	var share = document.getElementById("share");
	var shareBtn = document.getElementById(sid);
	var pos = offset(shareBtn);
	
	var fbBtn = document.getElementById("fbBtn");
	fbBtn.value = img;
	
	//var pin = document.getElementById("pinit").querySelector("a");
	//pin.href = "https://www.pinterest.com/pin/create/button/?url=" + img + "&description=Pin%20it!";
	
	share.style.display = "block";
	var sW = share.offsetWidth;
	share.style.top = pos.top + "px";
	share.style.left = (pos.left - (sW - 20 ) ) + "px";

	
		//fetch viewComments class to hide 
	var commClass = document.getElementsByClassName("viewComments");
	
	for( var c = 0; c < commClass.length; c++ ){
		   commClass[c].style.display = "none";
	}
	
	
}

function offset(el) {
    var rect = el.getBoundingClientRect(),
    scrollLeft = window.pageXOffset || document.documentElement.scrollLeft,
    scrollTop = window.pageYOffset || document.documentElement.scrollTop;
    return { top: rect.top + scrollTop, left: rect.left + scrollLeft }
}
	
function updateCartCount(xhttp){
	var cCount = xhttp.responseText;
	document.getElementById("cartNumSpan").innerHTML = cCount;
}
	
function updateCartContent(xhttp){
	var cContent = xhttp.responseText;
	document.getElementById("cartContent").innerHTML = cContent;
	var cModal = document.getElementById("cart_modal").style.display;
	//if( cModal === "none" ){
	  w3_open('cart_modal','100%'); 
	   //}	
}
	
function removeItem(xhttp) {
	var conf = xhttp.responseText;
	loadPage('../components/current_cart_count.php', updateCartCount);
	loadPage('../components/query_cart_contents.php', updateCartContent);
}
	
function paymentContent(which){
	var payOrNo = which;
	if( payOrNo == "pay" ){
	document.getElementById("cartStep2").style.display = "block";
	document.getElementById("cartStep1").style.display = "none";
	document.getElementById("cartButtons1").style.display = "none";	
	}
	if( payOrNo == "nopay" ){
	document.getElementById("cartStep2").style.display = "none";
	document.getElementById("cartStep1").style.display = "block";
	document.getElementById("cartButtons1").style.display = "block";
	}
}
	
function postAjax(url, data, success) {

    var params = typeof data == 'string' ? data : Object.keys(data).map(
            function(k){ return encodeURIComponent(k) + '=' + encodeURIComponent(data[k]) }
        ).join('&');

    var xhr = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
    xhr.open('POST', url);
    xhr.onreadystatechange = function() {
        if (xhr.readyState>3 && xhr.status==200) { success(xhr.responseText); 
		
													  if( xhr.responseText.split("_")[0] == "commented" ){
														 //alert( xhr.responseText );
														 // alert(xhr.responseText.split("_")[2]);
														  var cid = xhr.responseText.split("_")[1];
														  var loc = xhr.responseText.split("_")[2];
														  fetchComments(loc,cid);
														  loadPage2('../components/query_comment_count.php?cid=' + cid, commentCount, cid, loc);
														 }
												  	  else if( xhr.responseText == "true" ){
														 //alert( xhr.responseText );
														  showUpdate();
														 }
												  	  else if( xhr.responseText == "badpass" ){
														var msgp = document.getElementById("badlogin");
														  msgp.innerHTML = "Incorrect password entered.";
														  msgp.style.display = "block";
															  }
												  
												  	  else if( xhr.responseText == "baduser" ){
														var msgu = document.getElementById("badlogin");
														  msgu.innerHTML = "Incorrect username entered.";
														  msgu.style.display = "block";
															  }
												  	  else if( xhr.responseText == "error" ){
														var msgu = document.getElementById("badlogin");
														  msgu.innerHTML = "There was an issue logging in.";
														  msgu.style.display = "block";
															  }
												  	  else if( xhr.responseText == "newGood" ){
														var msgng = document.getElementById("regMsg");
														  msgng.innerHTML = "Thanks for registering! Please log in.";
														  msgng.style.display = "block";
														  cancelReg();
															  }
												  	  else if( xhr.responseText == "newBad" ){
														var msgnb = document.getElementById("regMsg");
														  msgnb.innerHTML = "Oops. Something went wrong. Please contact us!";
														  msgnb.style.display = "block";
															  }
												  	  else if( xhr.responseText == "cartGood" ){
														  document.getElementById("cartIcon").classList.add("w3-text-theme");
														 loadPage('../components/current_cart_count.php', updateCartCount);
															  }
												  	  else if( xhr.responseText == "cartBad" ){
														alert("Cart BAD!");
															  }
												  	  else if( xhr.responseText == "commented" ){
														alert("Comment good!");
															  }
												  	  else if( xhr.responseText == "commentBad" ){
														alert("Comment BAD!");
															  }

													  else{
														  loadAcct( xhr.responseText );
													  	}													 


												 }//end success function
    };
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send(params);
    return xhr;
	
}
	
function checkAjax(url, data, success) {

    var params = typeof data == 'string' ? data : Object.keys(data).map(
            function(k){ return encodeURIComponent(k) + '=' + encodeURIComponent(data[k]) }
        ).join('&');

    var xhr = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
    xhr.open('POST', url);
    xhr.onreadystatechange = function() {
        if (xhr.readyState>3 && xhr.status==200) { success(xhr.responseText); 
													var vals = xhr.responseText.split("~");
												  updateChecks( vals[0], vals[1] );
												 }//end success function
    };
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send(params);
    return xhr;
	
}
	
	
	
function loadAcct( where ){
		var urlVar = where;
	   window.location.assign("../pages/vc_account.php?accordion=" + urlVar);
}
	

function toggleSetting( toToggle ){
	
	var tt = toToggle;
	var tvA = document.getElementById(tt).checked;
	var tv;
	if( tvA == true ){
		tv = "yes"
		}
	else{
		tv = "no";
	}
		var togObj = '{"toToggle":"' + tt + '","toggleVal":"' + tv +'"}';
		//alert( togObj );
		togObj = JSON.parse(togObj);
	postAjax('../components/query_toggle_setting.php', togObj, function(data){ console.log(data); });
	
}
	
function showUpdate(){
	
	var update = document.getElementById("afterCheck");

  var opac = 0;
  var id = setInterval(frame, 40);
  
  function frame() {
    if (opac >= 0.8) {
		//alert("hello?");
      clearInterval(id, opac);
		
	  clearUpdate( update );
    } else {
      opac += 0.02; 
      update.style.opacity = opac;  
    }
  }	
}
	
function clearUpdate( ud, o ){

var update = ud;
  var opac = 0.8;
  var id = setInterval(frameout, 20);
  
  function frameout() {
    if (opac <= 0) {
      clearInterval(id);
    } else {
      opac -= 0.02; 
      update.style.opacity = opac;  
    }
  }	
}



function noticeChecks(){
	
	var nchecks = document.getElementsByClassName("noticeChecks");
	var nLen = nchecks.length;

	
	for( var n=0; n < nLen; n++ ){
		var nId = [];
		try{ throw n }
		catch(nn){
		nId[nn] = nchecks[nn].id;
		var checkObj = '{"toCheck":"' + nId[nn] + '"}';
			//alert(checkObj);
		checkObj = JSON.parse(checkObj);
		checkAjax('../components/query_check_setting.php', checkObj, function(data){ console.log(data); });
		}
	}
	
}
	
	
	
function updateChecks(key, val){
	
	var keyL = key;
	var valL = val;
	if( valL == "yes" ){
	var check = document.getElementById(keyL);
	check.checked = "checked";
	}
	
}
	
	
function getID(rawid){
	var tid = rawid.split("_");
	var tid2 = tid[1];
	if( tid[0] == 'oid' ){
	   orderDetails(tid2);	   
	   }
	else if( tid[0] == 'mid' ){
		methodDetails(tid2, tid[0]);		
			}
	else if( tid[0] == 'newMethod' ){
		methodDetails(tid2, tid[0]);
	}
	
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
	
function methodDetails(mid, which){
	var method_id = mid;
	var editOrNew = which;
	
	if( editOrNew == 'newMethod' ){
	   
		document.getElementById("methodForm").action = "../components/query_add_method.php";
		document.getElementById("remove_method").style.display = "none";
		document.getElementById("methodHeader").innerHTML = "Add Payment Method";
		
			document.getElementById("m_nickname").value = '';
			document.getElementById("m_name").value = '';
			document.getElementById("m_expires").value = '';
			document.getElementById("m_zip").value = '';
			document.getElementById("m_id").value = '';
		
	   }
	else if( editOrNew != 'newMethod' ){
	var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
				var theMethod = JSON.parse(this.responseText);
			
			document.getElementById("methodForm").action = "../components/query_update_method.php";
			document.getElementById("methodHeader").innerHTML = "Edit Payment Method";
			document.getElementById("m_nickname").value = theMethod.nickname;
			document.getElementById("m_name").value = theMethod.name_on_card;
			document.getElementById("m_expires").value = theMethod.expires_month + "/" + theMethod.expires_year;
			document.getElementById("m_zip").value = theMethod.billing_zip;
			document.getElementById("m_id").value = theMethod.mid;
			document.getElementById("remove_method").value = theMethod.mid;
			//document.getElementById("m_edit").value = "ask_" + theMethod.mid;
			document.getElementById("remove_method").style.display = "block";

			}
  		};
			xhttp.open("GET", "../components/query_method_detail.php?mid=" + method_id, true);
			xhttp.send();
	}//end else editOrNew
		document.getElementById('method_modal').style.display='block';
	
}
	
function removeMethod(theId){
	
	var mid = theId;
	var midObj = '{"mid":"' + mid + '"}';
	//alert(midObj);
	midObj = JSON.parse(midObj);
	postAjax('../components/query_remove_method.php', midObj, function(data){ console.log(data); });
	
}
	
	
</script>