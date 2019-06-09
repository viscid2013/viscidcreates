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
	//echo "<div>new cart!</div>" ;
	
	$sizes = array($size);
	//print_r($sizes);
	
	$_SESSION['id_sizes'] = array($addId=>$sizes);
	
}
elseif( isset($_SESSION['id_sizes']) ){
	echo "<div>existing cart!</div>";
	
	print_r($_SESSION['id_sizes'][$addId]);
	$iscount = count($_SESSION['id_sizes'][$addId]);
	
	echo "<br />***<br />";
	
	foreach( $_SESSION['id_sizes'] as $key=>$value ){
		
		
		if( $key == $addId ){
			echo "<div style='border: 1px solid #c00; background: #ccc; padding: 3px;'>";
			echo "SIZES B4 B4: <br />";
			print_r($_SESSION['id_sizes'][$addId]);//<-- only getting first index of the sizes array as compared to line 25
			$sizes = $_SESSION['id_sizes'][$addId];//<<<----PROBLEM: on the first new ID (compared to first one entered), this will keep replacing Index 0 of the Size array with the latest size BEFORE the array_push
			echo "<div style='color: red; padding: 4px; border: 1px solid #ccc;'>key: " . $key . " =? AddId: " . $addId . "</div>";
			echo "<div>ID match</div>";
		echo "<br />SIZES B4<br />";
			print_r($sizes);
			array_push( $sizes, $size );
		echo "<br />SIZES AFTER<br />";
			print_r($sizes);			
			$_SESSION['id_sizes'][$addId] = $sizes;
			echo "</div>";
		}
		else{
		echo "<div style='border: 1px solid #c00; background: #c00; font-color: #fff; padding: 3px;'>";
			echo "<div style='color: red; padding: 4px; border: 1px solid #ccc;'>key: " . $key . " =? AddId: " . $addId . "</div>";
			echo "<div>NO ID match</div>";
			if( count($_SESSION['id_sizes'][$addId]) > 0  ){
				$sizes = $_SESSION['id_sizes'][$addId];
			}
			else{
				$sizes = array($size);
			}	
			//print_r($sizes);
		$_SESSION['id_sizes'][$addId] = $sizes;
		//print_r($_SESSION['id_sizes']);
			echo "</div>";
		}
		//echo "End existing cart<br />";
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
	//echo "cartGood";
	
	echo "<br />FINAL SESSION SIZES<br />";
			print_r($_SESSION['id_sizes']);
	
	echo "<br />";

	/*foreach( $_SESSION['id_sizes'] as $k=>$v ){
		echo "KEYA: " . $k . " | VALUEA: " . $v . "<br />";
		foreach( $v as $kk=>$vv ){
			echo "KEYB: " . $kk . " | VALUEB: " . $vv . "<br />";
		}
	}*/
	
}
else{
	echo "cartBad";
}



?>