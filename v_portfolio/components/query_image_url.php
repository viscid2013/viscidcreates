<?php

// Program to display current page URL. 
  
$link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 
                "https" : "http") . "://" . $_SERVER['HTTP_HOST'] .  
                $_SERVER['REQUEST_URI']; 
  
echo $link; 

if (isset($_REQUEST['iid'])){
	$iid = $_REQUEST['iid'];
}
else{
	$iid = "";
}


include("vcinfo.inc");




try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT * from inventory WHERE iid = :iid"); 
    $stmt->bindParam(':iid', $iid);
	$stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
	
	$result = "http://beamcreates.com/v_portfolio/?imgDiv=yes";
	
	echo $result;
	
	if( isset($_REQUEST['imgDiv']) ){
		
		echo "<img src='../v_portfolio/images/" . $result["image_link"] . "' alt='viscid creates image' title='" . $result["title"] . "' />";

	}
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;



?>

