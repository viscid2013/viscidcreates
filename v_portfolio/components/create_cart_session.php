<?php
session_start();

if( isset($_REQUEST['addId']) ){
	$addId = $_REQUEST['addId'];
}

if( isset($_REQUEST['size']) ){
	$size = $_REQUEST['size'];
}

//create or update cart vars
if (!isset($_SESSION['id_sizes'])) {
	//echo "new cart!" ;
	
	$_SESSION['id_sizes'] = array($addId . "_" .$size);
	
}
elseif( isset($_SESSION['id_sizes']) ){
	//echo "existing cart!";
	array_push( $_SESSION['id_sizes'], $addId . "_" .$size );
}

//set user or guest
if (!isset($_SESSION['loggedin'])) {

	$_SESSION['user'] = 'guest';
	
}
elseif(isset($_SESSION['loggedin'])){
	$_SESSION['user'] = $_SESSION['id'];
}

if( count($_SESSION['id_sizes']) > 0 ){
	echo "cartGood";
	//echo "<br />";
	/*$cart = [];
	foreach( $_SESSION['id_sizes'] as $key=>$val ){
		$cart[$key] = explode( "_", $val );
		echo "Cart Key 0: " . $cart[$key][0] . "<br />";
		echo "Cart Key 1: " . $cart[$key][1] . "<br />";
		 //echo "K: " . $key . "V: " . $val . "<br />";
		foreach( $cart[$key] as $k=>$v ){
			echo "K: " . $k . " | V: " . $v;
			echo "<br />";
		}	
		echo "_____<br />";
	};*/

	
}
else{
	echo "cartBad";
}



?>