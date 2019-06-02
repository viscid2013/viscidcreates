<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>

	<?php
	echo '{"orders":';
	$zeroArray = array("title", "oid", "date_created");
	$zeroArray2 = array( $zeroArray[0]=>"What?", $zeroArray[1]=>"No orders yet?", $zeroArray[2]=>"Better get to ordering!" );
		$resultJSON = json_encode( $zeroArray2 );
	echo $resultJSON;
	echo '}';
	?>
	
</body>
</html>