<link rel = "stylesheet"
      type = "text/css"
      href = "dbLib.css" />

<?php
//spyLib.php
//holds utilities for spy database

//variables
$userName = "user";
$dbPass = "password";
$serverName = "localhost";
$adminPassword = "absolute";
$dbName = "ph_6";
$dbConn = "";
$mainProgram = "spyMaster.php";

function connectToDb(){
  //connects to the DB
  global $serverName, $userName, $dbPass, $dbName;
  $dbConn = mysql_connect($serverName, $userName, $dbPass);
  if (!$dbConn){
    print "<h3>problem connecting to database...</h3>\n";
    print "<h3>" . mysql_error() . "</h3> \n";
  } // end if
  
  $select = mysql_select_db("$dbName");
  if (!$select){
    print "<h3>problem selecting database...</h3>\n";
    print "<h3>" . mysql_error() . "</h3> \n";
  } // end if
  return $dbConn;
} // end connectToDb

function qToList($query){
  //given a query, makes a quick list of data
  global $dbConn;
  $output = "<p> \n";
  $result = mysql_query($query, $dbConn);

  while ($row = mysql_fetch_assoc($result)){
    foreach ($row as $col=>$val){
      $output .= "$col: $val<br />\n";
    } // end foreach
    $output .= "</p> \n" ;
  } // end while
  return $output;
} // end qToList

function qToTable($query){
  //given a query, automatically creates an HTML table output
  global $dbConn;
  $output = "";
  $result = mysql_query($query, $dbConn);

  $output .= "<table border = '1'>\n";
  //get column headings

  //get field names
  $output .= "<tr>\n";
  while ($field = mysql_fetch_field($result)){
    $output .= "  <th>$field->name</th>\n";
  } // end while
  $output .= "</tr>\n\n";

  //get row data as an associative array
  while ($row = mysql_fetch_assoc($result)){
    $output .= "<tr>\n";
    //look at each field
    foreach ($row as $col=>$val){
      $output .= "  <td>$val</td>\n";
    } // end foreach
    $output .= "</tr>\n\n";
  }// end while

  $output .= "</table>\n";
  return $output;
} // end qToTable

function tToEdit($tableName){
  //given a table name, generates HTML table including
  //add, delete and edit buttons
  
  $tableName = filter_input(INPUT_POST, "tableName");
  $tableName = mysql_real_escape_string($tableName);
  
  global $dbConn;
  $output = "";
  $query = "SELECT * FROM $tableName";

  $result = mysql_query($query, $dbConn);

  $output .= "<table border = '1'>\n";
  //get column headings

  //get field names
  $output .= "<tr>\n";
  while ($field = mysql_fetch_field($result)){
    $output .= "  <th>$field->name</th>\n";
  } // end while

  //get name of index field (presuming it's first field)
  $keyField = mysql_fetch_field($result, 0);
  $keyName = $keyField->name;
  
  //add empty columns for add, edit, and delete
  $output .= "<th></th><th></th>\n";
  $output .= "</tr>\n\n";

  //get row data as an associative array
  while ($row = mysql_fetch_assoc($result)){
    $output .= "<tr>\n";
    //look at each field
    foreach ($row as $col=>$val){
      $output .= "  <td>$val</td>\n";
    } // end foreach
    //build little forms for add, delete and edit


    //delete = DELETE FROM <table> WHERE <key> = <keyval>
    $keyVal = $row["$keyName"];
    $output .= <<< HERE

  <td>
    <form action = "deleteRecord.php"
          method = "post">
    <fieldset class = "tiny">
    <input type = "hidden"
           name = "tableName"
           value = "$tableName" />
    <input type= "hidden"
           name = "keyName"
           value = "$keyName" />
    <input type = "hidden"
           name = "keyVal"
           value = "$keyVal" />
    <input type = "submit"
           value = "delete" />
    </fieldset>
    </form>
  </td>

HERE;
    //update: won't update yet, but set up edit form
    $output .= <<< HERE
  <td>
    <form action = "editRecord.php"
          method = "post">
    <fieldset class = "tiny">
    <input type = "hidden"
           name = "tableName"
           value = "$tableName" />
    <input type= "hidden"
           name = "keyName"
           value = "$keyName" />
    <input type = "hidden"
           name = "keyVal"
           value = "$keyVal" />
    <input type = "submit"
           value = "edit" />
  </fieldset>
  </form>
  </td>

HERE;

    $output .= "</tr>\n\n";
    
  }// end while

    //add = INSERT INTO <table> {values}
    //set up insert form send table name
    $keyVal = $row["$keyName"];
    $output .= <<< HERE
<tr>
  <td colspan = "6">
    <form action = "addRecord.php"
          method = "post">
    <fieldset class = "tiny">
    <input type = "hidden"
           name = "tableName"
           value = "$tableName" />
    <button type = "submit">
       add a record
    </button>
    </fieldset>
    </form>
  </td>
</tr>
</table>

HERE;


  return $output;
} // end tToEdit

function rToEdit ($query){
  //given a one-record query, creates a form to edit that record
  //works on any table, but allows direct editing of keys
  //use smartRToEdit instead if you can
  
  global $dbConn;
  $output = "";
  $result = mysql_query($query, $dbConn);
  $row = mysql_fetch_assoc($result);

  //get table name from field object
  $fieldObj = mysql_fetch_field($result, 0);
  $tableName = $fieldObj->table;

  $output .= <<< HERE
<form action = "updateRecord.php"
      method = "post">
      
<fieldset>
      
  <input type = "hidden"
         name = "tableName"
         value = "$tableName" />

HERE;

  foreach ($row as $col=>$val){
    $output .= <<<HERE
  <label>$col</label>
  <input type = "text"
         name = "$col"
         value = "$val" />

HERE;
  } // end foreach
  $output .= <<< HERE
  <button type = "submit">
    update this record
  </button>
</fieldset>
</form>

HERE;
  return $output;
} // end rToEdit

function smartRToEdit ($query){
  //given a one-record query, creates a form to edit that record
  //Doesn't let user edit first (primary key) field
  //generates dropdown list for foreign keys
  //MUCH safer than ordinary rToEdit function

  // --restrictions on table design--
  //foreign keys MUST be named tableID where 'table' is table name
  //  (because mySQL doesn't recognize foreign key indicators)
  // I also expect a 'name' field in any table used as a foreign key
  //   (for same reason)
  
  global $dbConn;
  $output = "";
  $result = mysql_query($query, $dbConn);
  $row = mysql_fetch_assoc($result);

  //get table name from field object
  $fieldObj = mysql_fetch_field($result, 0);
  $tableName = $fieldObj->table;

  $output .= <<< HERE
<form action = "updateRecord.php"
      method = "post">
<fieldset>
  <input type = "hidden"
         name = "tableName"
         value = "$tableName" />
<dl>
HERE;
  $fieldNum = 0;
  foreach ($row as $col=>$val){
    if ($fieldNum == 0){
      //it's primary key.  don't make textbox,
      //but store value in hidden field instead
      //user shouldn't be able to edit primary keys
      $output .= <<<HERE
  
    <dt>$col</dt>
    <dd>$val
    <input type = "hidden"
           name = "$col"
             value = "$val" /></dd>
             
             
HERE;
    } else if (preg_match("/(.*)ID$/", $col, $match)) {
      //it's a foreign key reference
      // get table name (match[1])
      //create a listbox based on table name and its name field
      $valList = fieldToList($match[1],$col, $fieldNum, "name");
      
      $output .= <<<HERE
    <dt>$col</dt>
    <dd>$valList</dd>
  
HERE;

    } else {
      $output .= <<<HERE
    <dt>$col</dt>
    <dd>
    <input type = "text"
           name = "$col"
           value = "$val" /></dd>

HERE;
    } // end if
    $fieldNum++;
  } // end foreach
  $output .= <<< HERE
  </dl>
      <button type = "submit">
         update this record
      </button>
</fieldset>
</form>

HERE;
  return $output;
} // end smartRToEdit

function updateRec($tableName, $fields, $vals){
  //expects name of a record, fields array values array
  //updates database with new values
  
  global $dbConn;
  
  $output = "";
  $keyName = $fields[0];
  $keyVal = $vals[0];
  $query = "";
  
  $query .= "UPDATE $tableName SET \n";
  for ($i = 1; $i < count($fields); $i++){
    $query .= $fields[$i];
    $query .= " = '";
    $query .= $vals[$i];
    $query .= "',\n";
  } // end for loop

  //remove last comma from output
  $query = substr($query, 0, strlen($query) - 2);
  
  $query .= "\nWHERE $keyName = '$keyVal'";

  $result = mysql_query($query, $dbConn);
  if ($result){
    $query = "SELECT * FROM $tableName WHERE $keyName = '$keyVal'";
    $output .= "<h1>update successful</h1>\n";
    $output .= "<h2>new value of record:</h2>";
    $output .= qToTable($query);
  } else {
    $output .= "<h3>there was a problem...</h3><pre>$query</pre>\n";
  } // end if
  return $output;
} // end updateRec

function delRec ($table, $keyName, $keyVal){
  //deletes $keyVal record from $table
  global $dbConn;
  $output = "";
  $query = "DELETE from $table WHERE $keyName = '$keyVal'";
  //print "query is $query<br>\n";
  $result = mysql_query($query, $dbConn);
  if ($result){
    $output = "<h3>Record sucessfully deleted</h3>\n";
  } else {
    $output = "<h3>Error deleting record</h3>\n";
  } //end if
  return $output;
} // end delRec

function tToAdd($tableName){
  //given table name, generates HTML form to add an entry to the
  //table.  Works like smartRToEdit in recognizing foreign keys
  
  global $dbConn;
  $output = "";
  
  //process a query just to get field names
  $query = "SELECT * FROM $tableName";
  $result = mysql_query($query, $dbConn) or die(mysql_error());

  $output .= <<<HERE
  <form action = "processAdd.php"
        method = "post">
    <fieldset>
    <dl>
      <dt>Field</dt>
      <dd>Value</dd>
    
HERE;

  $fieldNum = 0;
  while ($theField = mysql_fetch_field($result)){
    $fieldName = $theField->name;
    if ($fieldNum == 0){
      //it's the primary key field.  It'll be autoNumber
      $output .= <<<HERE
 
        <dt>$fieldName</dt>
        <dd>AUTONUMBER
          <input type = "hidden"
                 name = "$fieldName"
                 value = "null">
        </dd>

HERE;
    } else if (preg_match("/(.*)ID$/", $fieldName, $match)) {
      //it's a foreign key reference.  Use fieldToList to get
      //a select object for this field

      $valList = fieldToList($match[1],$fieldName, 0, "name");
      $output .= <<<HERE
        <dt>$fieldName</dt>
        <dd>$valList</dd>

HERE;
    } else {
    //it's an ordinary field.  Print a text box
    $output .= <<<HERE
        <dt>$fieldName</dt>
        <dd><input type = "text"
                   name = "$fieldName"
                   value = "">
        </dd>

HERE;
    } // end if
    $fieldNum++;
  } // end while
  $output .= <<<HERE
    </dl>
    
        <input type = "hidden"
               name = "tableName"
               value = "$tableName">
        <button type = "submit">
           add record
        </button>
    </fieldset>
  </form>

HERE;

  return $output;
      
} // end tToAdd

function procAdd($tableName, $fields, $vals){
  //generates INSERT query, applies to database
  global $dbConn;
  
  $output = "";
  $query = "INSERT into $tableName VALUES (";
  foreach ($vals as $theValue){
    $query .= "'$theValue', ";
  } // end foreach

  //trim off trailing space and comma
  $query = substr($query, 0, strlen($query) - 2);
  
  $query .= ")";
  $output = "query is $query<br>\n";
  
  $result = mysql_query($query, $dbConn);
  if ($result){
    $output .= "<h3>Record added</h3>\n";
  } else {
    $output .= "<h3>There was an error</h3>\n";
  } // end if
  return $output;
} // end procAdd


function fieldToList($tableName, $keyName, $keyVal, $fieldName){
  //given table and field, generates an HTML select structure
  //named $keyName.  values will be key field of table, but
  //text will come from the $fieldName value.
  //keyVal indicates which element is currently selected
  
  global $dbConn;
  $output = "";
  $query = "SELECT $keyName, $fieldName FROM $tableName";
  $result = mysql_query($query, $dbConn);
  $output .= "<select name = \"$keyName\">\n";
  $recNum = 1;
  while ($row = mysql_fetch_assoc($result)){
    $theIndex = $row["$keyName"];
    $theValue = $row["$fieldName"];
    $output .= <<<HERE
  <option value = "$theIndex"
HERE;

    //make it currently selected item
    if ($theIndex == $keyVal){
      $output .= " selected = \"selected\"";
    } // end if
    $output .= ">$theValue</option>\n";
    $recNum++;
  } // end while
  $output .= "</select>\n";
  return $output;
} // end fieldToList

function mainButton(){
  // creates a button to return to the main program
  
  global $mainProgram;
  
  $output = <<< HERE
<form action = "$mainProgram"
      method = "get">
  <fieldset class = "tiny">
    <button type = "submit">
       return to main screen
    </button>
  </fieldset>
</form>

HERE;
  return $output;
} // end mainButton
  
?>
