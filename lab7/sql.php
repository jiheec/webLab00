<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<?php
		$db = new PDO("mysql:dbname=colleage", "root", "root");
		$rows = $db->query("SELECT * FROM student WHERE major = 'Computer Science'");
		
		foreach ($rows as $row){
			?>
				<li> First name : <?= $row["name"] ?></li>
			<?php
		}

	?>
</body>
</html>

