<?php

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
	
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
	
<meta property="og:url"                content="http://beamcreates.com/v_portfolio/pages/vc_home.php" />
<meta property="og:type"               content="website" />
<meta property="og:title"              content="<?php echo $result['title']; ?>" />
<meta property="og:description"        content="Arts and such" />
<meta property="og:image"              content="http://beamcreates.com/v_portfolio/images/<?php echo $result['image_link']; ?>" />
	
<title>Viscid Creates Images</title>
</head>

<body>

<?php
	
	if( isset($_REQUEST['pinit']) ){
		
		echo '<a href="https://www.pinterest.com/pin/create/button/" data-pin-do="buttonBookmark" onclick="window.close()"></a>';
	}
	
		echo "<img src='../images/" . $result["image_link"] . "' alt='" . $result["title"] . "' title='" . $result["title"] . "' style='width: 50px' />";

}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;	
	
?>
	
<script
    type="text/javascript"
    async defer
    src="//assets.pinterest.com/js/pinit.js"
></script>	
</body>
</html>