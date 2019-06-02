<?php

session_start();
if (isset($_SESSION['id'])){
	$uid = $_SESSION['id'];
}

if (isset($_REQUEST['m_nickname'])){
	$m_nickname= $_REQUEST['m_nickname'];
}

if (isset($_REQUEST['m_name'])){
	$m_name= $_REQUEST['m_name'];
}

if (isset($_REQUEST['m_zip'])){
	$m_zip= $_REQUEST['m_zip'];
}

if (isset($_REQUEST['expires_month'])){
	$expires_month= $_REQUEST['expires_month'];
}
if (isset($_REQUEST['expires_year'])){
	$expires_year= $_REQUEST['expires_year'];
}


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
    $sql = "INSERT INTO payment_methods (uid, nickname, name_on_card, expires_month, expires_year, billing_zip)
			VALUES
			('" . $uid . "',
			'" . $m_nickname . "',
			'" . $m_name . "',
			'" . $expires_month . "',
			'" . $expires_year . "',
			'" . $m_zip . "')
			WHERE uid = " . $uid;
    // use exec() because no results are returned

			$conn->exec($sql);
				
    echo "<script>window.location = '../pages/vc_account.php?accordion=billing'</script>";
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;


?>
