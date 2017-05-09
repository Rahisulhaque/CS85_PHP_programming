<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="EN" dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>View Query</title>
<?php include "dbLib.php"; ?>

</head>
<body>

<h1>Query Results</h1>

<?php 

$dbConn = connectToDb();

//get $queryID from previous form
$queryID = filter_input(INPUT_POST, "queryID");
$queryID = mysql_real_escape_string($queryID);

//use the queryID to get the requested query from the database
$sql = "SELECT * FROM storedQuery WHERE storedQuery.storedQueryID = $queryID";
$result = mysql_query($sql) or die (mysql_error());
$row = mysql_fetch_assoc($result);

$theQuery = $row["text"];
//print "Query: $theQuery";

print qToTable($theQuery);

print mainButton();

?>

</body>
</html>

