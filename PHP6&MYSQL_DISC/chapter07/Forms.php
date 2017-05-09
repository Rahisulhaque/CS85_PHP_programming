<?php 
include "SuperHTMLDef.php";
$s = new SuperHTML("Working with Forms");
$s->buildTop();

$s->startForm();
$s->label("User Name");
$s->textbox("userName", "Joe");

$numbers = array(
  "1"=>"ichii",
  "2"=>"nii",
  "3"=>"san",
  "4"=>"shi"
);

$s->label("Favorite number");
$s->select("favNumber", $numbers);

$s->submit();
$s->endForm();

print $s->formResults();

$s->buildBottom();

print $s->getPage();

?>
