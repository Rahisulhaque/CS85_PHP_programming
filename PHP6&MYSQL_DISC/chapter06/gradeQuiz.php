<?php

//retrieve data from form
$student = filter_input(INPUT_POST, "student");
$quizName = filter_input(INPUT_POST, "quizName");
$quest = $_REQUEST["quest"];

print <<<HERE

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="EN" dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Grade for $quizName, $student</title>
<link rel = "stylesheet"
      type = "text/css"
      href = "quiz.css" />
</head>
<body>

<h1>Grade for $quizName, $student</h1>
HERE;


//open up the correct master file for reading
$fileBase = str_replace(" ", "_", $quizName);
$masFile = $fileBase . ".mas";
$msfp = fopen($masFile, "r");

$logFile = $fileBase . ".log";

//the first three lines are name, instructor's email, and password
$quizName = fgets($msfp);
$quizEmail = fgets($msfp);
$quizPwd = fgets($msfp);

//step through the questions building an answer key
$numCorrect = 0;
$questionNumber = 1;
while (!feof($msfp)){
  $currentProblem = fgets($msfp);
  
  list($question, $answerA, $answerB, $answerC, $answerD, $correct) =
  split (":", $currentProblem);
  $key[$questionNumber] = $correct;
  $questionNumber++;
} // end while
fclose($msfp);

//Check each answer from user
for ($questionNumber = 1; $questionNumber <= count($quest); $questionNumber++){
  $guess = $quest[$questionNumber];
  $correct = $key[$questionNumber];
  $correct = rtrim($correct);
  //print "$questionNumber, Guess = $guess, Correct = $correct.<br>\n";
  if ($guess == $correct){
    //user got it right
    $numCorrect++;
    print "<p>problem # $questionNumber was correct</p> \n";
  } else {
    print <<<HERE
    <p style = "color: red">
      problem # $questionNumber was incorrect
    </p>

HERE;
  } // end if
} // end for

$percentage = ($numCorrect /count($quest)) * 100;

print <<<HERE
<p>
  you got $numCorrect right
  for $percentage percent
</p>
HERE;

date_default_timezone_set("AMERICA/INDIANA/INDIANAPOLIS");
$today = date("F j, Y, g:i a");

//print "Date: $today<br>\n";
$location = getenv("REMOTE_ADDR");
//print "Location: $location<br>\n";

//add results to log file
$lgfp = fopen($logFile, "a");
$logLine = $student . "\t";
$logLine .= $today . "\t";
$logLine .= $location . "\t";
$logLine .= $numCorrect . "\t";
$logLine .= $percentage . "\n";

fputs($lgfp, $logLine);
fclose($lgfp);

?>
</body>
</html>
