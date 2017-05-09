
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="EN" dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Spy Master Main Page</title>
<?php include "dbLib.php"; ?>

</head>
<body>
  <h1>Spy Master</h1>
<form action = "viewQuery.php"
      method = "post">
  <fieldset>
    <h2>View Data</h2>
    <select name = "queryID" size = "10">
    <?php
//get queries from storedQuery table

$dbConn = connectToDb();
$query = "SELECT * from storedQuery";
$result = mysql_query($query, $dbConn);
while($row = mysql_fetch_assoc($result)){
  $currentQuery = $row['storedQueryID'];
  $theDescription = $row['description'];
  print <<<HERE
      <option value = "$currentQuery">$theDescription</option>
  
HERE;
  } // end while
?>
    </select>
    <button type = "submit">
       execute request
    </button>
  </fieldset>
</form>

<form action = "editTable.php"
      method = "post">
  <fieldset>
    <h2>Edit / Delete table data</h2>
    <label>Password</label>
    <input type = "password"
           name = "pwd"
           value = "absolute" />

    <select name = "tableName"
            size = "5">
      <option value = "agent">agents</option>
      <option value = "specialty">specialties</option>
      <option value = "operation">operations</option>
      <option value = "agent_specialty">agent_specialty</option>
      <option value = "storedQuery">storedQuery</option>
    </select>
    
    <button type = "submit">
      edit table
    </button>         
  </fieldset>      

</form>

</body>
</html>

