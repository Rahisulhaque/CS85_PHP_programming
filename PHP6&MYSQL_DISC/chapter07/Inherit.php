<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="EN" dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Glitter Critter</title>
</head>
<body>
<?php 

// Incorporating Inheritance

//pull up the Critter class
include "critter.php";

//create new Glitter Critter based on Critter

class GlitterCritter extends Critter{
  //add one method
  function glow(){
    print "<p>" . $this->name . " gently shimmers...</p> \n";
  } // end glow

  //over-ride the setName method
  function setName($newName){
    $this->name = "Glittery " . $newName;
  } // end setName

} // end GC class def

//make an instance of the new critter
$theCritter = new GlitterCritter("Gloria");

//GC has no constructor, so it 'borrows' from its parent

print "<p>Critter name: " . $theCritter->getName() . "</p> \n";

//invoke new glow method
$theCritter->glow();



?>
</body>
</html>









