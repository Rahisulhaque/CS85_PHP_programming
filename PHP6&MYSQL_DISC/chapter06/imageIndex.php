<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="EN" dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>imageIndex</title>
</head>
<body>

<?php 
// image index
// generates an index file containing all images in a particular directory

//point to whatever directory you wish to index.
//index will be written to this directory as imageIndex.html
$dirName = "./pics";
$dp = opendir($dirName);
chdir($dirName);

//add all files in directory to $theFiles array
$currentFile = "";
while ($currentFile !== false){
  $currentFile = readDir($dp);
  $theFiles[] = $currentFile;
} // end while

//extract gif and jpg images
$imageFiles = preg_grep("/jpg$|gif$/", $theFiles);

$output = <<<HERE
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="EN" dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>imageIndex</title>
</head>
<body>

<div>
HERE;


foreach ($imageFiles as $currentFile){
  $output .= <<<HERE
<a href = "$currentFile">
  <img src = "$currentFile"
       height = "50"
       width = "50"
       alt = "$currentFile" />
</a>

HERE;

} // end foreach

$output .= <<<HERE
</div>
</body>
</html>

HERE;


//save the index to the local file system
$fp = fopen("imageIndex.html", "w");
fputs ($fp, $output);
fclose($fp);
//readFile("imageIndex.html");

print <<<HERE
<p>
<a href = "$dirName/imageIndex.html">
  image index
</a>
</p>

HERE;
 ?>
 
</body>
</html>

