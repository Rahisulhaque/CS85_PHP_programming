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
<?php 
//showLog.php
//shows a log file
//requires admin password

$password = filter_input(INPUT_POST, "password");
$logFile = filter_input(INPUT_POST, "logFile");

$logFile .= ".log";

if ($password == "absolute"){
  $lines = file($logFile);
  print "<pre>\n";
  foreach ($lines as $theLine){
    print $theLine;
  } // end foreach
  print "</pre>\n";

} else {
  print <<<HERE
  <p class = "error">
Incorrect Password.<br />
You must have a password in order to view this log.
</p>

HERE;
} // end if

?>
</body>
</html>

