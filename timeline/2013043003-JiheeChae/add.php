<?php
    # Ex 4 : Write a tweet
    try {
        include("timeline.php");

        if (!empty($_POST["author"]) && !empty($_POST["content"]) 
        	&& preg_match('/^[a-zA-Z]((-|\s)?[a-zA-Z]){0,19}$/', $_POST["author"])
            ) { 

        	$author = $_POST["author"];
	        $content = htmlspecialchars($_POST["content"]);
            //$content = $_POST["content"];
	              
	        $toadd = array($author,$content);

	        $tl = new TimeLine();
	        $tl -> add($toadd);

	        header("Location:index.php");
	        
        } else {
        	//echo "else";
            header("Location:error.php");
        }
        
    } catch(Exception $e) {
    	header("Location:error.php");
    }

   // && preg_match('/^[a-zA-Z]+(-[a-zA-Z]+)*(\s?[a-zA-Z]+(-[a-zA-Z]+)*)*$/', $_POST["author"])
    //!empty($_POST["author"]) && !empty($_POST["content"])
    //^[4][0-9]{15}
    ?>
