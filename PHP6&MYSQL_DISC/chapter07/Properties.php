<?php 
include "SuperHTMLDef.php";
$s = new SuperHTML("Basic Super Page");
$s->setTitle("I changed this");
$s->buildTop();
$title = $s->getTitle();
$s->tag("p", "I changed the title to $title");
$s->buildBottom();
print $s->getPage();
?>





