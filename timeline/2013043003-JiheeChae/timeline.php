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
        	$author = $this->db->quote($tweet[0]);
        	$contents = $this->db->quote($tweet[1]);
            $this->db->exec("INSERT INTO tweets (author, contents, time) VALUES (".$author.",".$contents.",now());");
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
                    <form method="POST" action="delete.php" class="delete-form">
                        <input type="submit" value="delete">
                        <input type="hidden" name="no" value="<?= $row['no']; ?>">
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
                        <?php
                        $conts = explode(" ", $row["contents"]);
                        
                        foreach($conts as $cont){
                            $subs = substr($cont,1);
                            echo preg_replace("/^#\S+/", "<a href='index.php?srchcontent=%23$subs&srch=Content'>$cont</a>", $cont)." ";
                        }
                        
                        ?>
                        
                    </div>
                </div>
            <?php

            }
        }

        public function searchTweets($type, $query) // This function load tweets meeting conditions
        {
        	$fornum = array();
        	$fornumint = 0;
            $rows = $this->db->query("SELECT * FROM tweets ORDER BY time DESC;");

            

            if(strcmp($type, "Author")==0 && !empty($query)){
            	foreach($rows as $row){
                	if(strpos($row["author"],$query) !== false){
	                	?>

	                	<div class="tweet">
                    		<form method="POST" action="delete.php" class="delete-form">
                                <input type="submit" value="delete">
                                <input type="hidden" name="no" value="<?= $row['no']?>">
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
		                        <?php
                                $conts = explode(" ", $row["contents"]);
                                
                                foreach($conts as $cont){
                                    $subs = substr($cont,1);
                                    echo preg_replace("/^#\S+/", "<a href='index.php?srchcontent=%23$subs&srch=Content'>$cont</a>", $cont)." ";
                                }
                                
                                ?>
		                    </div>
		                </div> <?php
            			
                	}
            	}
            } else if (strcmp($type, "Content")==0 && !empty($query)) {
            	foreach($rows as $row){
                	if(strpos($row["contents"],$query)  !== false){
	                	?>
	                	<div class="tweet">
                    		<form method="POST" action="delete.php" class="delete-form">
                                <input type="submit" value="delete">
                                <input type="hidden" name="no" value="<?= $row['no']?>">
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
		                        <?php
                                $conts = explode(" ", $row["contents"]);
                                
                                foreach($conts as $cont){
                                    $subs = substr($cont,1);
                                    echo preg_replace("/^#\S+/", "<a href='index.php?srchcontent=%23$subs&srch=Content'>$cont</a>", $cont)." ";
                                }
                                
                                ?>
		                    </div>
		                </div>

            		<?php
                	}
            	}
            } else if (strcmp($query, NULL)==0){
            	foreach($rows as $row){?>

                	<div class="tweet">
                    	<form method="POST" action="delete.php" class="delete-form">
                            <input type="submit" value="delete">
                            <input type="hidden" name="no" value="<?= $row['no']?>">
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
							<?php
                            $conts = explode(" ", $row["contents"]);
                            
                            foreach($conts as $cont){
                                $subs = substr($cont,1);
                                echo preg_replace("/^#\S+/", "<a href='index.php?srchcontent=%23$subs&srch=Content'>$cont</a>", $cont)." ";
                            }
                            
                            ?>
						</div>
					</div>

            		<?php
                	
            	}
            }  
        }
    }
?>
