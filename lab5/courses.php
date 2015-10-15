<!DOCTYPE html>
<html>
<head>
    <title>Course list</title>
    <meta charset="utf-8" />
    <link href="courses.css" type="text/css" rel="stylesheet" />
</head>
<body>
<div id="header">
    <h1>Courses at CSE</h1>
<!-- Ex. 1: File of Courses -->
        <?php 
            $filename = "courses.tsv";
            $lines = file($filename);
        ?>

    <p>
        Course list has <?= count($lines); ?> total courses
        and
        size of <?= (int)filesize($filename); ?> bytes.
    </p>
</div>
<div class="article">
    <div class="section">
        <h2>Today's Courses</h2>
<!-- Ex. 2: Today’s Courses & Ex 6: Query Parameters -->
        <?php
            function getCoursesByNumber($listOfCourses, $numberOfCourses){
                $resultArray = array();

                shuffle($listOfCourses);

                foreach($listOfCourses as $Course){
                    $resultArray[] = $Course;
                    if (count($resultArray) == $numberOfCourses) { break; }
                }                
                return $resultArray;
            }
            if (empty($_GET["number_of_courses"])||!isset($_GET["number_of_courses"])){
                $numberOfCourses = 3;
            }
            else {
                $numberOfCourses = $_GET["number_of_courses"];
            }
            $todaysCourses = getCoursesByNumber($lines, $numberOfCourses);
        ?>
        <ol>
            <?php foreach($todaysCourses as $forto){
                    $org = explode("\t", $forto); ?>
            <li> <?= $org[0]. " - ". $org[1] ?></li>
            <?php
                }
            ?>
        </ol>

    </div>
    <div class="section">
        <h2>Searching Courses</h2>
<!-- Ex. 3: Searching Courses & Ex 6: Query Parameters -->
        <?php
            function getCoursesByCharacter($listOfCourses, $startCharacter){
                $resultArray = array();
                foreach ($listOfCourses as $course) {
                    $cou = explode(("\t"), $course);
                    if(substr($cou[0], 0, 1) == $startCharacter){
                        $resultArray[] = $course;
                    }
                }
                return $resultArray;
            }

            if( !isset($_GET["character"])|| $_GET["character"] == "") {
                $startCharacter = "C";
            }
            else 
                $startCharacter = $_GET["character"];
            
            $searchedCourses = getCoursesByCharacter($lines, $startCharacter);
        ?>
        <p>
            Courses that started by <strong><?= "'".$startCharacter."'" ?></strong> are followings :
        </p>
        <ol>
            <?php foreach ($searchedCourses as $searched) {
            $sea = explode("\t",$searched);?>
            <li><?= $sea[0]." - ".$sea[1] ?></li> <?php
        }?>
            
        </ol>
    </div>
    <div class="section">
        <h2>List of Courses</h2>
<!-- Ex. 4: List of Courses & Ex 6: Query Parameters -->
        <?php
            function getCoursesByOrder($listOfCourses, $orderby){
                $resultArray = $listOfCourses;

                if($orderby == 0){
                    sort($resultArray);
                }
                else if($orderby == 1){
                    rsort($resultArray);
                }
                return $resultArray;
            }

            if(!isset($_GET["orderby"]) || $_GET["orderby"] == "") {
                $orderby = 0;
            }
            else 
                $orderby = $_GET["orderby"];

            $orderedCourses = getCoursesByOrder($lines, $orderby);
        ?>
        <?php
        if($orderby == 0){?>
        <p>
            All of courses ordered by <strong>alphabetical order</strong> are followings :
        </p>
        <?php }
        else if($orderby == 1){?>
        <p>
            All of courses ordered by <strong>alphabetical reverse order</strong> are followings :
        </p>
        <?php }?>

        <ol>
        <?php

            foreach ($orderedCourses as $ordered) {
            $ord = explode("\t",$ordered);

            if (strlen($ord[0]) > 20) { ?>
                    <li class="long"><?= $ord[0]." - ".$ord[1] ?></li>
                 <?php } else { ?>
                    <li><?= $ord[0]." - ".$ord[1] ?></li>
                 <?php 
                }
            }?>
        </ol>
 <!-- 
        <p>
            All of courses ordered by <strong>alphabetical order</strong> are followings :
        </p>


      <ol>
            <li class="long">ARTIFICIAL INTELLIGENCE - CSE4007</li>
            <li>BIG DATA PROCESSING - CSE4036</li>
            <li class="long">COMPILER CONSTRUCTION - CSE3009</li>
            <li>COMPUTER NETWORKS - CSE3027</li>
            <li>CRYPTOGRAPHY - CSE3029</li>
            <li class="long">EMBEDDED OPERATING SYSTEMS - CSE4035</li>
            <li>MOBILE COMPUTING - CSE4045</li>
            <li class="long">SOFTWARE CONVERGENCE STRATEGY - CSE3031</li>
            <li class="long">WEB APPLICATION DEVELOPMENT - CSE3026</li>
        </ol>-->
    </div>
    <div class="section">
        <h2>Adding Courses</h2>
<!-- Ex. 5: Adding Courses & Ex 6: Query Parameters -->
        <?
        
        if(!isset($_GET["newCourse"])||!isset($_GET["code_of_course"])|| $newCourse == null || $newCourse == "" || 
            $codeOfCourse == null || $codeOfCourse == ""){
    ?>
        <p>Input course or code of the course doesn't exist.</p>
    <?} else {?>
        <p>Adding a course if success!</p>
    <?file_put_contents($filename,"\n".$newCourse."\t".$codeOfCourse,FILE_APPEND);
        $lines=file($filename);}?>
    </div>
</div>
<div id="footer">
    <a href="http://validator.w3.org/check/referer">
        <img src="http://selab.hanyang.ac.kr/courses/cse326/2015/problems/images/w3c-html.png" alt="Valid HTML5" />
    </a>
    <a href="http://jigsaw.w3.org/css-validator/check/referer">
        <img src="http://selab.hanyang.ac.kr/courses/cse326/2015/problems/images/w3c-css.png" alt="Valid CSS" />
    </a>
</div>
</body>
</html>