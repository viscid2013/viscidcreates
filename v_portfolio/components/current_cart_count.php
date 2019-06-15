<?php
session_start();

if( isset( $_SESSION['id_sizes'] ) ){
	
	$cartNumR = count($_SESSION['id_sizes'],COUNT_RECURSIVE);
	$cartNumA = count($_SESSION['id_sizes']);
	$currCount = ($cartNumR - $cartNumA);
}
else{
	$currCount = "0";
}

echo $currCount;

?>