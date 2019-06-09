<?php
session_start();

if( isset($_REQUEST['addId']) ){
	$addId = $_REQUEST['addId'];
}

if( isset($_REQUEST['size']) ){
	$size = $_REQUEST['size'];
}

$date_created = date("U");



include("vcinfo.inc");

//echo '{"order":';

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	$sqlA = "SELECT * FROM cart_guest ";
	
    $sql = "INSERT INTO cart_guest (addId, size, last, date_created, bgPos, bgSize, avatar_link)
    VALUES ('" . $vcEmail . "', '" . $vcFirst . "', '" . $vcLast . "','" . $date_created . "', '" . $bgPos . "','" . $bgSize . "', '" . $avatar_link . "')";
    // use exec() because no results are returned
	if( $conn->exec($sql) ){
		$sql2 = "INSERT INTO access (uid, date_created)
		SELECT uid, date_created FROM users 
		WHERE (email = '" . $vcEmail . "') AND (last = '" . $vcLast . "')";
		
		if( $conn->exec($sql2) ){
			
			$stmt = $conn->prepare( 'SELECT uid FROM users WHERE email = :email' );
			$stmt->bindParam(':email',$vcEmail);
			$stmt->execute();
			$uid = $stmt->fetch(PDO::FETCH_ASSOC);
			$uid = $uid['uid'];

			$sql3 = "UPDATE access SET upass = '" . $vcPass . "' WHERE uid = ". $uid . "";
			//$conn->exec($sql3);
		}
		if( $conn->exec($sql3) ){
			
			$stmt2 = $conn->prepare( "INSERT INTO user_settings ( uid, email_notices, text_notices, email_sales, email_content ) VALUES (:uid, 'no','no','no','no')" );
			$stmt2->bindParam(':uid',$uid);
			$stmt2->execute();

		}
		
		
	}
    echo "cartGood";
    }
catch(PDOException $e)
    {
    //echo $sql . "<br>" . $e->getMessage();
	echo "cartBad";
    }

$conn = null;



?>