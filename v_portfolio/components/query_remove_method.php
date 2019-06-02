<?php

session_start();
if (isset($_SESSION['id'])){
	$uid = $_SESSION['id'];
}

if (isset($_REQUEST['mid'])){
	$mid= $_REQUEST['mid'];
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
    $sql = "DELETE FROM payment_methods WHERE mid = " . $mid . " AND uid = ". $uid . "";
    // use exec() because no results are returned

			$conn->exec($sql);
				
    echo "billing";
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;


?>
