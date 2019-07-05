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
	
	$result = $link . "?imgDiv=yes";
	
	echo $result;
	
	if( isset($_REQUEST['imgDiv']) ){
		
		?>
	<!doctype html>
<html>
<head>
<meta charset="utf-8">
	
<meta property="og:url"                content="http://beamcreates.com/v_portfolio/pages/vc_home.php" />
<meta property="og:type"               content="images" />
<meta property="og:title"              content="Viscid Creates" />
<meta property="og:description"        content="Arts and such" />
<meta property="og:image"              content="http://beamcreates.com/v_portfolio/images/" . $result["image_link"] />
	
<title>Viscid Creates</title>
</head>
<body>
<?php
		echo "<img src='../v_portfolio/images/" . $result["image_link"] . "' alt='viscid creates image' title='" . $result["title"] . "' />";
		
		echo "</body></html>";
	}
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;



?>

