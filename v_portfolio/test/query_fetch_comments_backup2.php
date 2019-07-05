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

	if (isset($_REQUEST['loc'])){
		$loc = $_REQUEST['loc'];
	}

include("vcinfo.inc");


try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	

		
		$stmt2 = $conn->prepare("SELECT * FROM comments WHERE iid = :iid2"); 
		$stmt2->bindParam(':iid2', $iid);
		$stmt2->execute();
    	
		$result = $stmt2->fetchAll(PDO::FETCH_ASSOC);
		$count  = $stmt2->rowCount();
		
		for( $i = 0; $i < $count; $i++ ){
			
			//$date[$i] = $result[$i]["date_commented"];
			$date[$i] = DateTime::createFromFormat( 'U', $result[$i]["date_commented"] );
			$date[$i] = $date[$i]->format( 'm.d.y g:i a' );
			
			$stmt3[$i] = $conn->prepare("SELECT * FROM users WHERE uid = :uid"); 
			$stmt3[$i]->bindParam(':uid', $result[$i]["uid"]);
			$stmt3[$i]->execute();

			$result3[$i] = $stmt3[$i]->fetch(PDO::FETCH_ASSOC);
			
			echo $result[$i]["comment"] . "_" . $count . "_" . $loc . "_" . $iid . "_" . $result3[$i]["uname"] . "_" . $date[$i] . "_" . $result3[$i]["avatar_link"];
		}
	
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;

} //end user set else

?>
