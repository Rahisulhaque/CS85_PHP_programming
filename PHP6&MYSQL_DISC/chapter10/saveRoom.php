<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="EN" dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>SaveRoom.php</title>
</head>
<body>

<?php 
//Once a room has been edited by editSegment, this program
//updates the database accordingly.

//connect to database
$conn  = mysql_connect("localhost", "user", "password") or die(mysql_error());
$select = mysql_select_db("ph_6", $conn);

//pull data from form
$name = filter_input(INPUT_POST, "name");
$description = filter_input(INPUT_POST, "description");
$north = filter_input(INPUT_POST, "north");
$east = filter_input(INPUT_POST, "east");
$south = filter_input(INPUT_POST, "south");
$west = filter_input(INPUT_POST, "west");
$id = filter_input(INPUT_POST, "id");

//clean up all data
$name = mysql_real_escape_string($name);
$description = mysql_real_escape_string($description);
$north = mysql_real_escape_string($north);
$east = mysql_real_escape_string($east);
$south = mysql_real_escape_string($south);
$west = mysql_real_escape_string($west);
$id = mysql_real_escape_string($id);

$sql = <<< END

UPDATE adventure
SET
  name = '$name',
  description = '$description',
  north = $north,
  east = $east,
  south = $south,
  west = $west
WHERE
  id = $id;

END;

print "<pre>$sql</pre> \n";

$result = mysql_query($sql) or die(mysql_error());
if ($result){
  print "<h3>$name room updated successfully</h3>\n";
  print "<p><a href = \"listSegments.php\">view the rooms</a></p>\n";
} else {
  print "<h3>There was a problem with the database</h3>\n";
} // end if

?>
</body>
</html>
