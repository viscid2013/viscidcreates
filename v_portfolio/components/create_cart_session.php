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
	
	$sizes = array($size);

	$_SESSION['id_sizes'] = array($addId=>$sizes);
	
}
elseif( isset($_SESSION['id_sizes']) ){

	

	$iscount = count($_SESSION['id_sizes'][$addId]);
	
	
	foreach( $_SESSION['id_sizes'] as $key=>$value ){
		
		
		if( $key == $addId ){

			$sizes = $_SESSION['id_sizes'][$addId];
			array_push( $sizes, $size );
		
			$_SESSION['id_sizes'][$addId] = $sizes;

		}
		else{

			if( count($_SESSION['id_sizes'][$addId]) > 0  ){
				$sizes = $_SESSION['id_sizes'][$addId];
			}
			else{
				$sizes = array($size);
			}	

		$_SESSION['id_sizes'][$addId] = $sizes;

		}
		
	}

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