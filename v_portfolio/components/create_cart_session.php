<?php
session_start();
//session_unset();
//session_destroy();

if( isset($_REQUEST['addId']) ){
	$addId = $_REQUEST['addId'];
}

if( isset($_REQUEST['size']) ){
	$size = $_REQUEST['size'];
}

//create or update cart vars
if (!isset($_SESSION['cart_items'])) {
	echo "new cart!" ;
	$_SESSION['cart_items'] = array($addId);
	$_SESSION['id_sizes'] = array( $addId=>$size );
	
	
}
elseif( isset($_SESSION['cart_items']) ){
	echo "existing cart!";
	array_push($_SESSION['cart_items'], $addId);
	$_SESSION['id_sizes'][$addId] = $size;
}

//set user or guest
if (!isset($_SESSION['loggedin'])) {

	$_SESSION['user'] = 'guest';
	
}
elseif(isset($_SESSION['loggedin'])){
	$_SESSION['user'] = $_SESSION['id'];
}

if( isset($_SESSION['cart_items']) && count( $_SESSION['cart_items'] ) >= 1 ){
	echo "cartGood";
}
else{
	echo "cartBad";
}



?>