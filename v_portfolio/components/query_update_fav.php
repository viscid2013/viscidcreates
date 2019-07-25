<?php

session_start();
if (!isset($_SESSION['id'])){
	echo "false";
}
elseif (isset($_SESSION['id'])){
	
	$uid = $_SESSION['id'];
	
	if (isset($_REQUEST['iid'])){
		$iid = $_REQUEST['iid'];
	}

	if (isset($_REQUEST['mvd'])){
		$mvd = $_REQUEST['mvd'];
	}


include("vcinfo.inc");


try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	$stmt = $conn->prepare("SELECT * FROM faves WHERE (iid = :iid) AND (uid = :iid)"); 
			$stmt->bindParam(':iid', $iid);
			$stmt->bindParam(':uid', $uid);
			$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
	
	$checkExist = $stmt->rowCount();
	
	if( $checkExist > 0 ){
		
		$stmt1 = $conn->prepare("SELECT * FROM faves WHERE iid = :iid"); 
			$stmt1->bindParam(':iid', $iid);
			$stmt1->execute();
		$result = $stmt1->fetch(PDO::FETCH_ASSOC);

		$newNumFav = $stmt1->rowCount();

		$stmt2 = $conn->prepare("UPDATE inventory SET num_favs = :newNumFav WHERE iid = :iid"); 
			$stmt2->bindParam(':newNumFav', $newNumFav);
			$stmt2->bindParam(':iid', $iid);

		$stmt2->execute();
	}
	else {
		$stmt0 = $conn->prepare("INSERT INTO faves ( iid, uid ) VALUES ( :iid0, :uid )"); 
		$stmt0->bindParam(':iid0', $iid);
		$stmt0->bindParam(':uid', $uid);
		
		$stmt0->execute();		

		$stmt1 = $conn->prepare("SELECT * FROM faves WHERE iid = :iid"); 
			$stmt1->bindParam(':iid', $iid);
			$stmt1->execute();
		$result = $stmt1->fetch(PDO::FETCH_ASSOC);

		$newNumFav = $stmt1->rowCount();

		$stmt2 = $conn->prepare("UPDATE inventory SET num_favs = :newNumFav WHERE iid = :iid"); 
			$stmt2->bindParam(':newNumFav', $newNumFav);
			$stmt2->bindParam(':iid', $iid);

		$stmt2->execute();
		
		}//else if checkExist
		
	echo $newNumFav . "_" . $iid . "_" . $mvd;
		
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;

} //end user set else

?>
