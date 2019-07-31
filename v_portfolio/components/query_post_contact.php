<?php

session_start();
if (isset($_SESSION['id'])){
	$uid = $_SESSION['id'];
}
else{
	$uid = 0;
}
	if (isset($_REQUEST['email_contact'])){
		$email = $_REQUEST['email_contact'];
	}

	if (isset($_REQUEST['name_contact'])){
		$name = $_REQUEST['name_contact'];
	}
	
	if (isset($_REQUEST['topic_contact'])){
		$topic = $_REQUEST['topic_contact'];
	}
	if (isset($_REQUEST['details_contact'])){
		$details = $_REQUEST['details_contact'];
	}

	$date_contact = date("U");


include("vcinfo.inc");


try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	$stmt1 = $conn->prepare("INSERT INTO correspondence (uid, name, email, topic, details, date_of_contact) VALUES (:uid, :name, :email, :topic, :details, :date_c)"); 
		$stmt1->bindParam(':uid', $uid);
		$stmt1->bindParam(':name', $name);
		$stmt1->bindParam(':email', $email);
		$stmt1->bindParam(':topic', $topic);
		$stmt1->bindParam(':details', $details);
		$stmt1->bindParam(':date_c', $date_contact);
		
	
	if($stmt1->execute()){
		
		echo "contactGood";
		
	}
	else{
		echo "ContactBad";
	}
	
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;



?>
