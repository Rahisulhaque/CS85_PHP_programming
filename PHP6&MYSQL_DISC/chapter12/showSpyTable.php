<!doctype html public "-//W3C//DTD HTML 4.0 //EN"> 
<html>
<head>
<title>Show a spy table</title>
</head>
<body>
<?


include "spyLib.php";

$dbConn = connectToSpy();

/*$query = "
select agent.name, operation.name
FROM agent, operation
WHERE agent.operationID = operation.operationID";
*/
/*$query = "SELECT agent.name AS 'agent',
          agent.operationID,
          operation.name AS 'operation'
from agent, operation WHERE agent.operationID = operation.operationID";
*/

$query = "SELECT * FROM agent WHERE agentID = 3";

print smartRToEdit($query);

//print qToList($query);
//print qToTable($query);

//print tToEdit("agents");
//print "<h1>This is something</h1>";
//print fieldToList("operations","operationID","name");


?>
</body>
</html>
