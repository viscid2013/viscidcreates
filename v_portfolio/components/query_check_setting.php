<?php

session_start();
if (isset($_SESSION['id'])){
	$uid = $_SESSION['id'];
	//$uid = 18;
}

if (isset($_REQUEST['toCheck'])){
	$check = $_REQUEST['toCheck'];
}


include("vcinfo.inc");

//echo '{"order":';

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	if( $check == "email_notices" ){
		$stmt = $conn->prepare( "SELECT email_notices FROM user_settings WHERE uid = :uid" );
	}
	elseif( $check == "text_notices" ){
		$stmt = $conn->prepare( "SELECT text_notices FROM user_settings WHERE uid = :uid" );
	}
	elseif( $check == "email_sales" ){
		$stmt = $conn->prepare( "SELECT email_sales FROM user_settings WHERE uid = :uid" );
	}
	elseif( $check == "email_content"  ){
		$stmt = $conn->prepare( "SELECT email_content FROM user_settings WHERE uid = :uid" );
	}
			//$stmt->bindParam(':check',$check);
			$stmt->bindParam(':uid',$uid);
			
	if($stmt->execute()){
		$val = $stmt->fetch();
			//$val2 = $val[$check];
		//$val = implode(",",$val);
				
    $return = $check . "~" . $val[0];	
		echo $return;
	}
	
			
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;


?>
