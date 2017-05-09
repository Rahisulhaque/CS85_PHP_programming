<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="EN" dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Mailing List</title>
</head>
<body>

<?php 
//Simple Mail merge
//presumes tab-delimmited file called maillist.dat

$theData = file("maillist.dat");



foreach($theData as $line){
  $line = rtrim($line);
  print "<h3>$line</h3>\n";
  list($name, $email) = split("\t", $line);
  print "<p>Name: $name</p> \n";

  $message = <<<HERE
  
TO: $email:
Dear $name:

Thanks for being a part of the spam aficianado forum.  You asked to
be notified whenever a new recipe was posted.  Be sure to check our web
site for the delicious 'spam flambe with white sauce and cherries' recipe.

Sincerely,

Sam Spam,
Host of Spam Afficianados.

HERE;


  print "<pre>$message</pre> \n";

} // end foreach

?>
</body>
</html>

