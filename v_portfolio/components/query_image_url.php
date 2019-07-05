<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId            : '960610207610265',
      autoLogAppEvents : true,
      xfbml            : true,
      version          : 'v3.3'
    });
	  
  FB.ui({
  method: 'share_open_graph',
  action_type: 'og.likes',
  action_properties: JSON.stringify({
    object:'https://developers.facebook.com/docs/javascript/examples',
  })
}, function(response){
  // Debug response (optional)
  console.log(response);
});
	  
  };
</script>
<script async defer src="https://connect.facebook.net/en_US/sdk.js"></script>

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
    $stmt = $conn->prepare("SELECT * from inventory WHERE iid = :iid	"); 
    $stmt->bindParam(':iid', $iid);
	$stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
	
	$result = "http://192.168.2.9/v_portfolio/images/" . $result["image_link"];
	

	//echo "<div>";
	
	//include("../components/ShareBox.php"); 
	
	//echo "</div>";
	
	echo "<div><img src='" . $result . "' style='heigh: 50%; width: 50%;' /></div>";
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;



?>
