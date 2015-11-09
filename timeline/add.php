<?php
    # Ex 4 : Write a tweet
    try {
        include("timeline.php");

        if (!empty($_POST["author"]) && !empty($_POST["content"])) { 

            $author = $_POST["author"];
            $content = $_POST["content"];
            
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
    ?>
