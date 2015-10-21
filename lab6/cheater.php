<!DOCTYPE html>
<html>
	<head>
		<title>Grade Store</title>
		<link href="http://selab.hanyang.ac.kr/courses/cse326/2015/problems/pResources/gradestore.css" type="text/css" rel="stylesheet" />
	</head>

	<body>
		
		<?php
		# Ex 4 : 
		# Check the existance of each parameter using the PHP function 'isset'.
		# Check the blankness of an element in $_POST by comparing it to the empty string.
		# (can also use the element itself as a Boolean test!)
		# if (){
		?>

		<!-- Ex 4 : 
			Display the below error message : -->
		<?php
		$getname = isset($_POST["name"])? $_POST["name"] : ' ';
		$getid = isset($_POST["id"])? $_POST["id"] : ' ';
		$getcourse = isset($_POST["course"])? $_POST["course"] : ' ';
		$getgrade = isset($_POST["Grade"])? $_POST["Grade"] : ' ';
		$getccnum = isset($_POST["ccnum"])? $_POST["ccnum"] : ' ';
		$getcc = isset($_POST["cc"])? $_POST["cc"] : ' ';

		print $getccnum;

		if(!isset($_POST["name"])||!isset($_POST["name"])||!isset($_POST["course"])
			||!isset($_POST["Grade"])||!isset($_POST["ccnum"])||!isset($_POST["cc"])
			||empty($_POST["name"])||empty($_POST["id"])||empty($_POST["course"])
			||empty($_POST["Grade"])||empty($_POST["ccnum"])||empty($_POST["cc"])){?>

			<h1>Sorry</h1>
			<p>You didn't fill out the form completely. <a href="gradestore.html">Try again?</a></p>
		<?php
		}
			
		# Ex 5 : 
		# Check if the name is composed of alphabets, dash(-), ora single white space.
		# } elseif () { 
		
		elseif(!preg_match('/^[a-zA-Z]+(-[a-zA-Z]+)*([\s]?[a-zA-Z]+(-[a-zA-Z]+)*)?$/', $_POST["name"])){
			?>
			<h1>Sorry</h1>
			<p>You didn't provide a valid name. <a href="gradestore.html">Try again?</a></p>
			<?php
		}
		
		# Ex 5 : 
		# Check if the credit card number is composed of exactly 16 digits.
		# Check if the Visa card starts with 4 and MasterCard starts with 5. 
		# } elseif () {
		
		elseif ((!preg_match('/^[4][0-9]{15}/', $getccnum)&& $getcc=="visa")||(!preg_match('/^[5][0-9]{15}/', $getccnum) && $getcc=="mastercard")){
			?>

			<h1>Sorry</h1>
			<p>You didn't provide a valid credit card number. <a href="gradestore.html">Try again?</a></p>

			<?php
		}
		
		else {
		?>

		<h1>Thanks, looser!</h1>
		<p>Your information has been recorded.</p>
		
		<!-- Ex 2: display submitted data -->
		<?php 
			
			

			$cou = processCheckbox($getcourse); 
		?>

		<ul> 
			<li>Name: <?= $getname ?></li>
			<li>ID: <?= $getid ?></li>
			<!-- use the 'processCheckbox' function to display selected courses -->
			<li>Course:  <?= $cou ?></li>
			<li>Grade: <?= $getgrade ?></li>
			<li>Credit Card: <?= $getccnum ." (".$getcc .")" ?> </li>
		</ul>
		
		
		<p>Here are all the loosers who have submitted here:</p>

		<?php
			$filename = "loosers.txt";
			/* Ex 3: 
			 * Save the submitted data to the file 'loosers.txt' in the format of : "name;id;cardnumber;cardtype".
			 * For example, "Scott Lee;20110115238;4300523877775238;visa"
			 */
			$putcontent = $getname.";".$getid.";".$getccnum.";".$getcc."\n";
			file_put_contents($filename, $putcontent, FILE_APPEND);

		?>
		
		<!-- Ex 3: Show the complete contents of "loosers.txt".
			 Place the file contents into an HTML <pre> element to preserve whitespace -->

		<p>
		<?php
			$fileget = file_get_contents($filename);
			$filegets = explode("\n", $fileget);
			foreach($filegets as $gets){?>
				 <?= $gets ?> </br> <?php 
			}
		?>
		</p>
		
		<?php

	}
			/* Ex 2: 
			 * Assume that the argument to this function is array of names for the checkboxes ("cse326", "cse107", "cse603", "cin870")
			 * 
			 * The function checks whether the checkbox is selected or not and 
			 * collects all the selected checkboxes into a single string with comma seperation.
			 * For example, "cse326, cse603, cin870"
			 */

			function processCheckbox($names) {
				/*
				if(count($getcourse)==1){
					print $getcourse[0];
					$course = $getcourse[0];
				}
				elseif (count($getcourse)==2) {
				 	$course = $getcourse[0].", ".$getcourse[1];
				}
				elseif (count($getcourse)==3) {
					$course = $getcourse[0].", ".$getcourse[1].", ".$getcourse[2];
				}
				elseif (count($getcourse)==4) {
					$course = $getcourse[0].", ".$getcourse[1].", ".$getcourse[2].", ".$getcourse[3];
				}
				*/
				$course = implode(", ", $names);

				return $course;
				
			}


			
		?>
		
	</body>
</html>
