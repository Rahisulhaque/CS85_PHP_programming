<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="EN" dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Show Adventure</title>
<link rel = "stylesheet"
      type = "text/css"
      href = "showSegment.css" />
      
</head>
<body>

<?php 
//connect to database
$conn  = mysql_connect("localhost", "user", "password") or die(mysql_connect());

//get input
$room = filter_input(INPUT_POST, "room");
$room = mysql_real_escape_string($room);
if (empty($room)){
  $room = 1;
} // end if

//prepare the query
$select = mysql_select_db("ph_6", $conn);
$sql = "SELECT * FROM adventure WHERE id = '$room'";
$result = mysql_query($sql)or die(mysql_connect());
$mainRow = mysql_fetch_assoc($result);
$theText = $mainRow["description"];

$northButton = buildButton("north");
$eastButton = buildButton("east");
$westButton = buildButton("west");
$southButton = buildButton("south");
$roomName = $mainRow["name"];

print <<<HERE
<h1>$roomName</h1>
<form method = "post"
      action = "">
<table border = "1">
<tr>
  <td></td>
  <td>$northButton</td>
  <td></td>
</tr>

<tr>
  <td>$eastButton</td>
  <td>$theText</td>
  <td>$westButton</td>
</tr>

<tr>
  <td></td>
  <td>$southButton</td>
  <td></td>
</tr>

</table>
<p>
<input type = "submit"
       value = "go"
       id = "btnSubmit" />
</p>
</form>

HERE;

function buildButton($dir){
  //builds a button for the specified direction
  global $mainRow, $conn;
  $newID = $mainRow[$dir];
  //print "newID is $newID";
  $query = "SELECT name FROM adventure WHERE id = $newID";
  $result = mysql_query($query, $conn);
  $row = mysql_fetch_assoc($result);
  $roomName = $row["name"];

  $buttonText = <<< HERE
  <input type = "radio"
         name = "room"
         value = "$newID" />$roomName

HERE;

  return $buttonText;

} // end build button
?>
</body>
</html>
