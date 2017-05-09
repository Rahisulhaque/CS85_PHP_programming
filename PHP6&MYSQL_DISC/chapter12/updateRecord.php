<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="EN" dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Update Record</title>
<?php include "dbLib.php"; ?>
</head>

<body>

<h2>Update Record</h2>
<?php 
$dbConn = connectToDb();

$fieldNames = "";
$fieldValues = "";

foreach ($_REQUEST as $fieldName => $value){
  if ($fieldName == "tableName"){
    $theTable = $value;
  } else {
    $fieldName = mysql_real_escape_string($fieldName);
    $value = mysql_real_escape_string($value);
    $fields[] = $fieldName;
    $values[] = $value;
  } // end if
} // end foreach

print updateRec($theTable, $fields, $values);

print mainButton();

?>
</body>
</html>
