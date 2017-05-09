<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="EN" dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include "dbLib.php"; ?>
<title>Add a Record</title>
</head>
<body>
<h2>Add Record</h2>
<?php 

$dbConn = connectToDb();

$tableName = filter_input(INPUT_POST, "tableName");
$tableName = mysql_real_escape_string($tableName);

print tToAdd($tableName);
print mainButton();

?>

</body>
</html>

