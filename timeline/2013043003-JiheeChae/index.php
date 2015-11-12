<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Simple Timeline</title>
        <link rel="stylesheet" href="timeline.css">
    </head>
    <body>
        <div>
            <a href="index.php"><h1>Simple Timeline</h1></a>
            <div class="search">
                <!-- Ex 3: Modify forms -->
                <form method="GET" class="search-form">
                    <input type="submit" value="search">
                    <input type="text" name="srchcontent" placeholder="Search">
                    <select name="srch">
                        <option>Author</option>
                        <option>Content</option>
                    </select>
                </form>
            </div>

            <div class="panel">
            	
                <div class="panel-heading">
                    <!-- Ex 3: Modify forms -->
                    
                    <form action="add.php" method="POST" class="write-form">
                        <input type="text" name="author" placeholder="Author">
                        <div>
                            <input type="text" name="content" placeholder="Content">
                        </div>
                        <input type="submit" value="write">
                    </form>
                </div>
                <!-- Ex 3: Modify forms & Load tweets -->
                <?php
                	
                	include("timeline.php");
                	$tl = new TimeLine();

                	
                	if(isset($_GET["srchcontent"])){
                		$getsrch = isset($_GET["srch"]) ? $_GET["srch"] : ' ';
	                    $getsrchcontent = isset($_GET["srchcontent"]) ? $_GET["srchcontent"] : ' ';
	                    
	                	$tl -> searchTweets($getsrch, $getsrchcontent);
                	}
                	
                	else {
                		$tl -> loadTweets();
                	}
                	
                ?>
                <!--
                <div class="tweet">
                    <form class="delete-form">
                        <input type="submit" value="delete">
                        <input type="hidden">
                    </form>
                    <div class="tweet-info">
                        <span>Adele</span>
                        <span>11:30:11 04/11/2015</span>
                    </div>
                    <div class="tweet-content">
                        Nevermind I'll find someone like you
                    </div>
                </div>
                <div class="tweet">
                    <form class="delete-form">
                        <input type="submit" value="delete">
                        <input type="hidden">
                    </form>
                    <div class="tweet-info">
                        <span>Adele</span>
                        <span>11:30:11 04/11/2015</span>
                    </div>
                    <div class="tweet-content">
                        Nevermind I'll find someone like you
                    </div>
                </div>
                <div class="tweet">
                    <form class="delete-form">
                        <input type="submit" value="delete">
                        <input type="hidden">
                    </form>
                    <div class="tweet-info">
                        <span>Adele</span>
                        <span>11:30:11 04/11/2015</span>
                    </div>
                    <div class="tweet-content">
                        Nevermind I'll find someone like you
                    </div>
                </div>
                <div class="tweet">
                    <form class="delete-form">
                        <input type="submit" value="delete">
                        <input type="hidden">
                    </form>
                    <div class="tweet-info">
                        <span>Adele</span>
                        <span>11:30:11 04/11/2015</span>
                    </div>
                    <div class="tweet-content">
                        Nevermind I'll find someone like you
                    </div>
                </div>
                <div class="tweet">
                    <form class="delete-form">
                        <input type="submit" value="delete">
                        <input type="hidden">
                    </form>
                    <div class="tweet-info">
                        <span>Adele</span>
                        <span>11:30:11 04/11/2015</span>
                    </div>
                    <div class="tweet-content">
                        Nevermind I'll find someone like you
                    </div>
                </div>
                <div class="tweet">
                    <form class="delete-form">
                        <input type="submit" value="delete">
                        <input type="hidden">
                    </form>
                    <div class="tweet-info">
                        <span>Adele</span>
                        <span>11:30:11 04/11/2015</span>
                    </div>
                    <div class="tweet-content">
                        Nevermind I'll find someone like you
                    </div>
                </div>-->
            </div>
        </div>
    </body>
</html>
