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
	
	$_SESSION['id_sizes'][] = "{'iid': '" . $addId . "' , 'size': '" . $size . "'}";
	
}
elseif( isset($_SESSION['id_sizes']) ){
	//echo "existing cart!";
	array_push($_SESSION['id_sizes'],"{'iid': '" . $addId . "' , 'size': '" . $size . "'}");
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

	
}
else{
	echo "cartBad";
}



?>