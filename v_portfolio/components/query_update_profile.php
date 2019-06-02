<?php

session_start();
if (isset($_SESSION['id'])){
	$uid = $_SESSION['id'];
}

if (isset($_REQUEST['acct_first'])){
	$acct_first= $_REQUEST['acct_first'];
}
if (isset($_REQUEST['acct_last'])){
	$acct_last= $_REQUEST['acct_last'];
}
if (isset($_REQUEST['acct_email'])){
	$acct_email= $_REQUEST['acct_email'];
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
    $sql = "UPDATE users SET first = '" . $acct_first . "', last = '" . $acct_last . "', email = '" . $acct_email . "' WHERE uid = ". $uid . "";
    // use exec() because no results are returned

			$conn->exec($sql);
				
    echo "profile";
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;


?>
