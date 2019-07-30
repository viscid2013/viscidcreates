<?php
session_start();
if (isset($_SESSION['id'])){
	$uid = $_SESSION['id'];
}

include("vcinfo.inc");

//echo '{"order":';

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT first, last, email, address1, address2, city, state, zip, avatar_link, bgPos, bgSize, date_of_birth, date_created
							FROM users
							WHERE uid = :uid
							"); 
    $stmt->bindParam(':uid', $uid);
	$stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
	
	echo "<div class='w3-padding'>Logged in as <span class='vcItalic'>" . $result["first"] . "&nbsp;" . $result["last"] . "</span></div>";

}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;


?>
