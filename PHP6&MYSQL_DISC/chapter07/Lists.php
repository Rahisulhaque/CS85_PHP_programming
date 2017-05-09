<?php 
include "SuperHTMLDef.php";
$s = new SuperHTML("Creating Lists");
$s->buildTop();

$myArray =array( "alpha", "beta", "gamma", "delta");

$s->h2("build an ordered list");
$s->buildList($myArray, "ol");

$s->h2("unordered lists are the default");
$s->buildList(array("alpha", "beta", "gamma", "delta"));

$s->h2("building a list with an id");
$s->buildList($myArray, "ol id = 'fancy'");
$s->buildBottom();
print $s->getPage();
?>





