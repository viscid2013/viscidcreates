<?php

if (isset($_REQUEST['vcEmail'])){
	$vcEmail = $_REQUEST['vcEmail'];
}
if (isset($_REQUEST['vcPass'])){
	$vcPass = $_REQUEST['vcPass'];
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
    $sql = "INSERT INTO users (email, first, last, date_created)
    VALUES ('" . $vcEmail . "', '" . $vcFirst . "', '" . $vcLast . "','" . $date_created . "')";
    // use exec() because no results are returned
    $conn->exec($sql);
    echo "New record created successfully";
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;


?>
