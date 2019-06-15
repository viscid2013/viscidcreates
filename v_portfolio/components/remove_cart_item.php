<?php
session_start();

if( isset( $_REQUEST['removeIt'] ) ){
	$remove = $_REQUEST['removeIt'];
}
//print_r($_SESSION['id_sizes']) . "<br />";

if( count($_SESSION['id_sizes']) <= 1 ){
	unset( $_SESSION['id_sizes'] );
	
}
elseif( count($_SESSION['id_sizes']) > 1 ){
	unset( $_SESSION['id_sizes'][$remove] );
}

echo "removed";

?>