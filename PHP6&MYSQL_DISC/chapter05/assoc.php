<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="EN" dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Associative array demo</title>
<link rel = "stylesheet"
      type = "text/css"
      href = "assoc.css" />
</head>
<body>
<h1>Associative Array Demo</h1>
<?php 

$stateCap["Alaska"] = "Juneau";
$stateCap["Indiana"] = "Indianapolis";
$stateCap["Michigan"] = "Lansing";

$cap = $stateCap["Alaska"];

print <<<HERE

<h2>State Capital</h2>
<dl>
  <dt>Alaska</dt>
  <dd>$cap</dd>
</dl>
HERE;

$worldCap = array(
  "Albania"=>"Tirana",
  "Japan"=>"Tokyo",
  "United States"=>"Washington DC"
  );

$cap = $worldCap["Japan"];

print <<<HERE
<h2>World Capital</h2>
<dl>
  <dt>Japan</dt>
  <dd>$cap</dd>
</dl>

HERE;

print "<h2>World Capitals</h2> \n";
print "<dl> \n";

foreach ($worldCap as $country => $capital){
  //print "$country: $capital<br />\n";
  print <<<HERE
  <dt>$country</dt>
  <dd>$capital</dd>
  
HERE;
} // end foreach

print "</dl> \n";
?>

</body>
</html>

