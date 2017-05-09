<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="EN" dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Cartoonify</title>
</head>
<body>
<div>
<?php 
$fileName = "sonnet76.txt";

$sonnet = file($fileName);
$output = "";

foreach ($sonnet as $currentLine){
  $currentLine = str_replace("r", "w", $currentLine);
  $currentLine = str_replace("l", "w", $currentLine);
  $output .= rtrim($currentLine) . "<br />\n";
} // end foreach
  $output .= "You wascally wabbit!<br />\n";

print $output;

?>
</div>
</body>
</html>

