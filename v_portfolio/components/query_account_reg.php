<?php

if (isset($_REQUEST['vcemail'])){
	$vcEmail = $_REQUEST['vcemail'];
}
if (isset($_REQUEST['vcpass'])){
	$vcPass = $_REQUEST['vcpass'];
	$vcPass = password_hash($vcPass, PASSWORD_ARGON2I);
}
if (isset($_REQUEST['vcFirst'])){
	$vcFirst = $_REQUEST['vcFirst'];
}
if (isset($_REQUEST['vcLast'])){
	$vcLast = $_REQUEST['vcLast'];
}
$date_created = mktime();
$date_created = date("Y-m-d H:i:s",$date_created);

$bgPos = "center";
$bgSize = "100%";

$avatar_link = "../branding_icons/blankUser.svg";

include("vcinfo.inc");

//echo '{"order":';

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO users (email, first, last, date_created, bgPos, bgSize, avatar_link)
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
    echo "newGood";
    }
catch(PDOException $e)
    {
    //echo $sql . "<br>" . $e->getMessage();
	echo "newBad";
    }

$conn = null;
/*INSERT INTO access (uid, date_created)
SELECT uid, date_created FROM users
WHERE email='' AND last = '';*/

?>
