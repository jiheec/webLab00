<?php
# Ex 5 : Delete a tweet
try {
	include("timeline.php");

	//$hidden = $_POST["hid"];

	$tl = new TimeLine();
   // $tl -> delete($hidden);
    
    header("Location:index.php");
    
} catch(Exception $e) {
    header("Location:error.php");
}
?>
