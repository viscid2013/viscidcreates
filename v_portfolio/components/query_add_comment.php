<?php

session_start();
if (!isset($_SESSION['id'])){
	echo "false";
}
elseif (isset($_SESSION['id'])){
	
	$uid = $_SESSION['id'];
	
	if (isset($_REQUEST['comment_iid'])){
		$iid = $_REQUEST['comment_iid'];
	}

	if (isset($_REQUEST['comment_loc'])){
		$svm = $_REQUEST['comment_loc'];
	}
	
	if (isset($_REQUEST['comment'])){
		$comment = $_REQUEST['comment'];
	}

	$date_comment = date("U");


include("vcinfo.inc");


try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	$stmt1 = $conn->prepare("INSERT INTO comments (uid, iid, comment, date_commented) VALUES (:uid, :iid, :comment, :date_c)"); 
		$stmt1->bindParam(':uid', $uid);
		$stmt1->bindParam(':iid', $iid);
		$stmt1->bindParam(':comment', $comment);
		$stmt1->bindParam(':date_c', $date_comment);
		
	
	if($stmt1->execute()){
		
		$stmt2 = $conn->prepare("SELECT * FROM comments WHERE iid = :iid2"); 
		$stmt2->bindParam(':iid2', $iid);
		$stmt2->execute();
    	
		$result = $stmt2->fetchAll(PDO::FETCH_ASSOC);
		$count  = $stmt2->rowCount();
		
		if($count > 0) {
		echo "commented_" . $iid . "_" . $svm;	
		}
		else{
			"commentBad";
		}
		/*for( $i = 0; $i < $count; $i++ ){
			echo $result[$i]["comment"];
		}*/

		
	}
	
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;

} //end user set else

?>
