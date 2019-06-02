<?php

session_start();
if (isset($_SESSION['id'])){
	$uid = $_SESSION['id'];
}

if (isset($_REQUEST['bgPos'])){
	$bgPos= $_REQUEST['bgPos'];
}
else{
	$bgPos = "center";
}

if (isset($_REQUEST['bgSize'])){
	$bgSize= $_REQUEST['bgSize'];
}
else{
	$bgSize = "100%";
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
    $sql = "UPDATE users SET bgPos = '" . $bgPos . "', bgSize = '" . $bgSize . "' WHERE uid = ". $uid . "";
    // use exec() because no results are returned

			$conn->exec($sql);
				
    echo "<script>window.location = '../pages/vc_account.php?accordion=profile'</script>";
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;


?>
