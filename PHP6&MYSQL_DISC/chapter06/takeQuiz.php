<?php 
//takeQuiz.php
//given a quiz file, prints out that quiz
//no doctype, because that's embedded in HTML

//get password and filebase from form
$takeFile = filter_input(INPUT_POST, "takeFile");
$password = filter_input(INPUT_POST, "password");

//get the password from the file
$masterFile = $takeFile . ".mas";
$fp = fopen($masterFile, "r");
//the password is the third line, so get the first two lines, but ignore them
$dummy = fgets($fp);
$dummy = fgets($fp);
$magicWord = fgets($fp);
$magicWord = rtrim($magicWord);
fclose($fp);

if ($password == $magicWord){
  $htmlFile = $takeFile . ".html";
  //print out the page if the user got the password right
  readFile($htmlFile);
} else {
  print <<<HERE
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="EN" dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Quiz Builder</title>

<link rel = "stylesheet"
      type = "text/css"
      href = "quiz.css" />
      
</head>
<body>
  
<p class = "error">
Incorrect Password.<br />
You must have a password in order to take this quiz.
</p>
</body>
</html>

HERE;
} // end if
?>