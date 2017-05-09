<?php 
include "SuperHTMLDef.php";
$s = new SuperHTML("Adding Text and Tags");
$s->buildTop();

$s->addText("<p>This is ordinary text added to the document</p>");
$s->addText("<div>You can also add HTML code.</div>");

$s->h3("Use h1-h6 methods to add headings");
$s->addText("<div>");
$s->tag("em", "this line is emphasized");
$s->addText("</div>");
$s->buildBottom();
print $s->getPage();
?>





