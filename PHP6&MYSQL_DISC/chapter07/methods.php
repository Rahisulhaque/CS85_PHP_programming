<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="EN" dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Critter</title>
</head>
<body>
<?php 
// Adding methods

//define the critter class
class Critter{

  private $name;

  function __construct($handle = "anonymous"){
    $this->name = $handle;
  } // end constructor

  function setName($newName){
    $this->name = $newName;
  } // end setName

  function getName(){
    return $this->name;
  } // end getName

} // end Critter class

//make an instance of the critter
$theCritter = new Critter();

//print original name
print "<p>Initial name: " . $theCritter->getName() . "</p>\n";

print "<p>Changing name...</p>\n";
$theCritter->setName("Melville");
print "<p>New name: " . $theCritter->getName() . "</p>\n";

?>
</body>
</html>









