<?php
# Ex 5 : Delete a tweet
try {
	include("timeline.php");
	$tl = new TimeLine();

	$getno = isset($_POST["no"]) ? $_POST["no"] : ' ';
	$tl -> delete($getno);
    
    header("Location:index.php");
    
} catch(Exception $e) {
    header("Location:error.php");
}
?>
