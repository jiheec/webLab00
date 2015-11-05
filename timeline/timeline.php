<?php
    class TimeLine {
        # Ex 2 : Fill out the methods
        private $db;
        function __construct()
        {
            # You can change mysql username or password
            $this->db = new PDO("mysql:host=localhost;dbname=timeline", "root", "root");
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        
        public function add($tweet) // This function inserts a tweet
        {
            $this->db->exec("INSERT INTO tweets (author, contents, time) VALUES (".$tweet[0].",".$tweet[1].",now());");
        }

        public function delete($no) // This function deletes a tweet
        {
            $this->db->exec("DELETE FROM tweets WHERE no = ".$no.";");
        }

        # Ex 6: hash tag
        # Find has tag from the contents, add <a> tag using preg_replace() or preg_replace_callback()
        public function loadTweets() // This function load all tweets
        {
            $rows = $this->db->query("SELECT * FROM tweets ORDER BY time DESC;");
            
            foreach($rows as $row){?>
            	
                <div class="tweet">
                    <form action="delete.php" class="delete-form">
                        <input type="submit" value="delete">
                        <input type="hidden">
                    </form>
                    <div class="tweet-info">
                        <span><?= $row["author"]; ?></span>
						<?php
		                $totime = explode(" ",$row["time"]);
		                $todate = explode("-", $totime[0]);
		                $totime[0] = implode("/", $todate);
		                ?>
                        <span><?= $totime[1]." ".$totime[0] ?></span>
                    </div>
                    <div class="tweet-content">
                        <?= $row["contents"]; ?>
                    </div>
                </div>
            <?php

            }
            //Fill out here
        }

        public function searchTweets($type, $query) // This function load tweets meeting conditions
        {
        	$fornum = array();
        	$fornumint = 0;
            $rows = $this->db->query("SELECT * FROM tweets ORDER BY time DESC;");

            if(strcmp($type, "Author")==0){
            	foreach($rows as $row){
                	if(strpos($row["author"],$query) !== false){
	                	$fornum[$fornumint] = $row["no"]; 
	                	$fornumint = $fornumint+1;?>

	                	<div class="tweet">
                    		<form action="delete.php" class="delete-form">
		                        <input type="submit" value="delete">
		                        <input type="hidden">
                    		</form>
		                    <div class="tweet-info">
		                        <span><?= $row["author"]; ?></span>
		                        <?php
				                $totime = explode(" ",$row["time"]);
				                $todate = explode("-", $totime[0]);
				                $totime[0] = implode("/", $todate);
				                ?>
		                        <span><?= $totime[1]." ".$totime[0] ?></span>
		                    </div>
		                    <div class="tweet-content">
		                        <?= $row["contents"]; ?>
		                    </div>
		                </div> <?php
            			
                	}
            	}
            } else if (strcmp($type, "Content")==0) {
            	foreach($rows as $row){
                	if(strpos($row["contents"],$query)  !== false){
	                	$fornum[$fornumint] = $row["no"]; 
	                	$fornumint = $fornumint+1;?>

	                	<div class="tweet">
                    		<form action="delete.php" class="delete-form">
		                        <input type="submit" value="delete">
		                        <input type="hidden">
                    		</form>
		                    <div class="tweet-info">
		                        <span><?= $row["author"]; ?></span>
		                        $totime = explode(" ",$row["time"]);
				                $todate = explode("-", $totime[0]);
				                $totime[0] = implode("/", $todate);
				                ?>
		                        <span><?= $totime[1]." ".$totime[0] ?></span>
		                    </div>
		                    <div class="tweet-content">
		                        <?= $row["contents"]; ?>
		                    </div>
		                </div>

            		<?php
                	}
            	}
            } else if (empty($query)){
            	foreach($rows as $row){?>

                	<div class="tweet">
                    	<form action="delete.php" class="delete-form">
		                    <input type="submit" value="delete">
		                    <input type="hidden">
                  		</form>
	                   <div class="tweet-info">
						<span><?= $row["author"]; ?></span>
						$totime = explode(" ",$row["time"]);
						$todate = explode("-", $totime[0]);
						$totime[0] = implode("/", $todate);?>
						<span><?= $totime[1]." ".$totime[0] ?></span>
						</div>
						<div class="tweet-content">
							<?= $row["contents"]; ?>
						</div>
					</div>

            		<?php
                	
            	}

               	
            }

            
        }
    }
?>
