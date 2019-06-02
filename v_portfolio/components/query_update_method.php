<?php

session_start();
if (isset($_SESSION['id'])){
	$uid = $_SESSION['id'];
}

if (isset($_REQUEST['mid'])){
	$mid= $_REQUEST['mid'];
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

if (isset($_REQUEST['m_expires'])){
	$m_expires= $_REQUEST['m_expires'];
}

$expires = explode( "/", $m_expires); 

$expires_month = $expires[0];
$expires_year = $expires[1];


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
    $sql = "UPDATE payment_methods SET
			nickname = '" . $m_nickname . "',
			name_on_card = '" . $m_name . "',
			expires_month = '" . $expires_month . "',
			expires_year = '" . $expires_year . "',
			billing_zip = '" . $m_zip . "'
			WHERE mid = " . $mid . " AND uid = " . $uid;
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
