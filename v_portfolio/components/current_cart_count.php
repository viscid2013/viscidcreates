<?php
session_start();

if( isset( $_SESSION['cart_items'] ) ){
	$currCount = count($_SESSION['cart_items']);
}
else{
	$currCount = "0";
}

echo $currCount;

?>