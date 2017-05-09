<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="EN" dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Delete Record</title>
<?php include("dbLib.php"); ?>
</head>
<body>
<h2>Delete Record</h2>
<?php 
$dbConn = connectToDb();

//retrieve data
$tableName = filter_input(INPUT_POST, "tableName");
$keyName = filter_input(INPUT_POST, "keyName");
$keyVal = filter_input(INPUT_POST, "keyVal");
$tableName = mysql_real_escape_string($tableName);
$keyName = mysql_real_escape_string($keyName);
$keyVal = mysql_real_escape_string($keyVal);


print delRec($tableName, $keyName, $keyVal);
print mainButton();
?>

</body>
</html>

