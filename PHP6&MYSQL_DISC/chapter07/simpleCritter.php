<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="EN" dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Critter</title>
</head>
<body>
<?php 
// BASIC OOP DEMO

//define the critter class
class Critter{
  var $name;
} // end Critter class

//make an instance of the critter
$theCritter = new Critter();

//assign a value to the name property
$theCritter->name = "Andrew";

//return the value of the name property
print "<p>";
print "My name is ";
print $theCritter->name;
print "</p> \n";
?>
</body>
</html>





