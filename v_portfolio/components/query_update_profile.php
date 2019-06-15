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
if (isset($_REQUEST['address1'])){
	$address1= $_REQUEST['address1'];
}
if (isset($_REQUEST['address2'])){
	$address2= $_REQUEST['address2'];
}
if (isset($_REQUEST['city'])){
	$city= $_REQUEST['city'];
}
if (isset($_REQUEST['state'])){
	$state= $_REQUEST['state'];
}
if (isset($_REQUEST['zip'])){
	$zip= $_REQUEST['zip'];
}


/*else{
	$vcEmail = "";
}*/


include("vcinfo.inc");

//echo '{"order":';

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "UPDATE users SET first = '" . $acct_first . "', last = '" . $acct_last . "', email = '" . $acct_email . "', address1 = '" . $address1 . "', address2 = '" . $address2 . "', city = '" . $city . "', state = '" . $state . "', zip = '" . $zip . "' WHERE uid = ". $uid . "";
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
