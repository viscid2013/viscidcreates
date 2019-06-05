<?php
session_start();

if( isset($_REQUEST['addId']) ){
	$addId = $_REQUEST['addId'];
}

if( isset($_REQUEST['size']) ){
	$size = $_REQUEST['size'];
}

if (!isset($_SESSION['loggedin'])) {
	$_SESSION['guest_cart'] = array('addid'=>$addId, 'size'=>$size, 'user'=>'guest');
}
elseif(isset($_SESSION['loggedin'])){
	$_SESSION['user_cart'] = array('addid'=>$addId, 'size'=>$size, 'user'=>$_SESSION['id']);
}

if( isset($_SESSION['user_cart']) || isset($_SESSION['guest_cart']) ){
	echo "cartGood";	
}
else{
	echo "cartBad";
}


?>