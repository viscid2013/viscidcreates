<?php

	$vcEmail = 'viscid07@gmail.com';

	$vcPass = 'passypass5';

	$vcFirst = 'Ben';

	$vcLast = 'McFadden';

$date_created = mktime();
$date_created = date("Y-m-d H:i:s",$date_created);
/*else{
	$vcEmail = "";
}*/


$servername = "localhost";
$username = "phpmyadmin";
$password = "2020DofSM!";
$dbname = "viscid";

//echo '{"order":';

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			
			$stmt = $conn->prepare( 'SELECT uid FROM users WHERE email = :email' );
			$stmt->bindParam(':email',$vcEmail);
			$stmt->execute();
			$uid = $stmt->fetch(PDO::FETCH_ASSOC);
			
			//print_r($uid);
			echo $uid['uid'];
			//$uid = 16;
			//$plen = strlen($vcPass);
	
			/*$sql3 = $conn->prepare( 'SELECT uid FROM users WHERE email = :email' );
			//$sql3->bindParam(':uid',$uid, PDO::PARAM_INT);
			$sql3->bindParam(':email',$vcEmail);
			$sql3->execute();*/
			//$sql3 = "UPDATE access SET upass = '" . $vcPass . "' WHERE uid = ". $uid . "";
			//$conn->exec($sql3);

		
    echo "<br />New record created successfully";
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;
/*UPDATE access SET upass = :pass WHERE uid = :uid*/

?>
