<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="EN" dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel = "stylesheet"
      type = "text/css"
      href = "listSegments.css" />
      
<title>List Segments</title>
</head>
<body>
<h1>List Segments</h1>
<?php   

connect();

$sql = "SELECT * FROM adventure";
$result = mysql_query($sql) or die(mysql_error());

while ($row = mysql_fetch_assoc($result)){
  print <<<HERE
<form action = "editSegment.php"
      method = "post">
<table border = "1">

HERE;
//  print "<table border = \"1\">\n";

  foreach($row as $key=>$value){
    //print "$key: $value<br>\n";
    $roomNum = $row["id"];
    print <<<HERE
  <tr>
    <th>$key</th>
    <td>$value</td>
  </tr>
  
HERE;

  } // end foreach
  print <<<HERE
  <tr>
    <td colspan = "2">
      <input type = "hidden"
             name = "room"
             value = "$roomNum" />
      <button type = "submit">
        edit this room
      </button>      
    </td>
  </tr>
</table>

</form>
HERE;
  
} // end while

function connect(){
  global $conn, $select;
  $conn  = mysql_connect("localhost", "user", "password") or die(mysql_error());
  $select = mysql_select_db("ph_6", $conn);
} // end function

?>

</body>
</html>
