<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="EN" dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Edit table</title>
<?php include("dbLib.php"); ?>
</head>

<body>
<h1>Edit Table</h1>

<?php

//check password

$pwd = filter_input(INPUT_POST, "pwd");
$tableName = filter_input(INPUT_POST, "tableName");

if ($pwd == $adminPassword){
  $dbConn = connectToDb();
  
  //sanitize $tableName before using it in SQL
  $tableName = mysql_real_escape_string($tableName);
  
  print tToEdit("$tableName");
} else {
  print "<h2>You must have administrative access to proceed</h2>\n";
} // end if
print mainButton();

?>
</body>
</html>

