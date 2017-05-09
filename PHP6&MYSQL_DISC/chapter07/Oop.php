<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="EN" dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="content-type" content="text/xml; charset=utf-8" />
    <title>OOP Demo</title>
  </head>
<body>
<?php
// OOP DEMO

class Critter{
  var $name;
  
  function __construct($handle = "Anonymous"){
  	//constructor
  	$this->name = $handle;
  } // end constructor
  
  function sayName(){
	  return("<p>My name is $this->name</p> \n");
  } // end sayName
} // end Critter class

class GlitterCritter extends Critter {

  // note there is no constructor and no name property
  // yet they are available
  function glow(){
    print("<p>$this->name gently shimmers...</p>\n");
  } // end glow

} // end GC class def

class BitterCritter extends Critter {
  function __construct(){
    $this->name = "none of your business";
  } // end BC constructor

  function glower(){
    return "<p>Grrrrr...</p>\n";
  } // end glower
} // end BitterCritter class def

$first = new Critter("Orville");
$second = new Critter();
$third = new BitterCritter("George");
$fourth = new GlitterCritter("Gloria");
print "<div> \n";
print($first->sayName());
print($second->sayName());
print($third->sayName());
print($third->glower());
print($fourth->glow());

print "</div> \n";
?>
</body>
</html>
