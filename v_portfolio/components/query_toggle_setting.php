<?php

session_start();
if (isset($_SESSION['id'])){
	$uid = $_SESSION['id'];
}

if (isset($_REQUEST['toToggle'])){
	$toggle = $_REQUEST['toToggle'];
}
if (isset($_REQUEST['toggleVal'])){
	$togVal = $_REQUEST['toggleVal'];
}


$servername = "localhost";
$username = "phpmyadmin";
$password = "2020DofSM!";
$dbname = "viscid";

//echo '{"order":';

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "UPDATE user_settings SET " . $toggle . " = '" . $togVal . "' WHERE uid = ". $uid . "";
    // use exec() because no results are returned

			$conn->exec($sql);
				
    echo "true";
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;


?>
