<?php
session_start();

if( isset( $_SESSION['id_sizes'] ) ){
	$currCount = count($_SESSION['id_sizes']);
}
else{
	$currCount = "0";
}

echo $currCount;

?>