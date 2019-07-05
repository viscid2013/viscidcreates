<?php

session_start();
if (isset($_SESSION['id'])){
	
	$uid = $_SESSION['id'];
}
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
	

		
		$stmt2 = $conn->prepare("SELECT * FROM comments WHERE iid = :iid2 ORDER BY date_commented DESC"); 
		$stmt2->bindParam(':iid2', $iid);
		$stmt2->execute();
    	
		$result = $stmt2->fetchAll(PDO::FETCH_ASSOC);
		$count  = $stmt2->rowCount();
	
	echo "<div id='commFormContainer_"  . $iid .  "'></div>";
	
	if( $count < 1 ){
		
		echo "<div class='w3-container viewCommentsContainer' id='commentDiv_"  . $iid .  "'>
		
		<span class='w3-button w3-xlarge w3-right closeComments' onClick='document.getElementById(\"viewCommentsS_"  . $iid .  "\").style.display=\"none\"; document.getElementById(\"viewCommentsM_"  . $iid .  "\").style.display=\"none\"; document.getElementById(\"behindSlides_"  . $iid .  "\").style.display=\"none\"; document.getElementById(\"behindSlidesM_"  . $iid .  "\").style.display=\"none\"'>&times;</span>
		

			<div class='w3-padding w3-white viewCommentsInner' id='viewInnerM_"  . $iid .  "'>
				No comments yet!<br />
			</div>";
		
		if( !isset($_SESSION['loggedin']) ){
			echo '<a href="../pages/vc_account.php" class="w3-button w3-theme-action w3-center addCommentBtn">Log in to comment</a>';
		}
		
		else{
		echo "<div class='w3-button w3-theme-action w3-center addCommentBtn' id='commentButton_"  . $iid .  "' onClick='addComment(this.id, \"" . $loc . "\")'>
				Add Comment
			</div>";	
		}
				
		echo "</div>";
		
	
		
	} //end if count less than 0
	
	else{
		
			echo "<div class='w3-container viewCommentsContainer' id='commentDiv_"  . $iid .  "'>
		
		<span class='w3-button w3-xlarge w3-right closeComments' onClick='document.getElementById(\"viewCommentsS_"  . $iid .  "\").style.display=\"none\"; document.getElementById(\"viewCommentsM_"  . $iid .  "\").style.display=\"none\"; document.getElementById(\"behindSlides_"  . $iid .  "\").style.display=\"none\"; document.getElementById(\"behindSlidesM_"  . $iid .  "\").style.display=\"none\"'>&times;</span>
		

			<div class='w3-padding w3-white viewCommentsInner' id='viewInnerM_"  . $iid .  "'>";
	
		for( $i = 0; $i < $count; $i++ ){
			
			//$date[$i] = $result[$i]["date_commented"];
			$date[$i] = DateTime::createFromFormat( 'U', $result[$i]["date_commented"] );
			$date[$i] = $date[$i]->format( 'm.d.y g:i a' );
			
			$stmt3[$i] = $conn->prepare("SELECT * FROM users WHERE uid = :uid"); 
			$stmt3[$i]->bindParam(':uid', $result[$i]["uid"]);
			$stmt3[$i]->execute();

			$result3[$i] = $stmt3[$i]->fetch(PDO::FETCH_ASSOC);
			
			
			echo "<div><img src='" . $result3[$i]['avatar_link'] . "' style='width:20px' />&nbsp;" . $result3[$i]['uname'] . "</div><div class='vcItalic w3-border-bottom'><span>" . $result[$i]['comment'] . "</span>&nbsp;|&nbsp;<span>" . $date[$i] . "</span></div>";

		}
	
	echo "</div>";

		if( !isset($_SESSION['loggedin']) ){
			echo '<a href="../pages/vc_account.php" class="w3-button w3-theme-action w3-center addCommentBtn">Log in to comment</a>';
		}
		
		else{
			echo "<div class='w3-button w3-theme-action w3-center addCommentBtn' id='commentButton_"  . $iid .  "' onClick='addComment(this.id, \"" . $loc . "\")'>
				Add Comment
			</div>";
		}
		
		echo "</div>";
		
	}//end else if count more than 0
	
	
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;


?>
