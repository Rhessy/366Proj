<?php
//Function to retrieve database connection credentials from a specific text file 
function DbConnect() {
    $myfile = fopen("../pg_connection_info.txt", "r") or die("Unable to open file!");
	$my_host = fgets($myfile);
	$my_dbname = fgets($myfile);
	$my_user = fgets($myfile);
    $my_sslmode = fgets($myfile);
    $my_password = fgets($myfile);
    $dbhost = pg_connect("host=$my_host dbname=$my_dbname user=$my_user password=$my_password");
    fclose($myfile);
        
    if(!$dbhost)
	{
		die("Error1: ".pg_last_error());
	}

    return $dbhost;
}

/*Function to retrieve specific data from a specific table in the given databse, 
it will store the data from the specified table into an array and return the array,
for easy access of the data later
*/

function GetEmployeeData() {
  
    $sql = "SELECT empid, name FROM employee"; //Setting whatever query you want to run to a string variable 
    $result = pg_query(DbConnect(), $sql) or die("error to fetch data");  
    $data = array(); //Iinitializing ane mpty array 

    //If the query returns nothing send error message 
    if (!$result){ 
      echo "An error occuredb.\n";
      exit;
    }
    //while there is data in each given row add it to the array 
    while($row = pg_fetch_row($result)){
                $data[] = $row;
}

return $data; //return the data from the database table as an array 
}

function ManagerView($empid) {
    
  /* $sql = "SELECT * from employee WHERE empid = $empid"; */
  $sql = "SELECT employee.*, route.routeid FROM employee LEFT OUTER JOIN route ON (employee.empid = route.empid) WHERE employee.empid = $empid"; 
  $result = pg_query(DbConnect(), $sql) or die("error to fetch data");  
  $data = array(); //Iinitializing an empty array 
  
  //If the query returns nothing send error message 
  if (!$result){ 
    echo "An error occured.\n";
    exit;
   }

  //while there is data in each given row add it to the array 
  while($row = pg_fetch_row($result)){
        $data[] = $row;
  }

  return $data; //return the data from the database table as an array 
}

function ManagerEdit($empid, $New_route) {
  $sql = "update employee set route = $New_route, where name = $empid"; //Setting whatever query you want to run to a string variable 

    ManagerView($emp_name);
}
    
function Display_Hub() {

  $sql = "SELECT hub.hubid, hub.address, COUNT(route.busid), COUNT(route.hubid) FROM hub LEFT OUTER JOIN route ON (hub.hubid = route.hubid) GROUP BY hub.hubid ORDER BY hub.hubid ASC"; //Setting whatever query you want to run to a string variable 
  $result = pg_query(DbConnect(), $sql) or die("error to fetch data");  
  $data = array(); //Iinitializing ane mpty array 
  
  //If the query returns nothing send error message 
  if (!$result){ 
    echo "An error occured.\n";
    exit;
  }
    //while there is data in each given row add it to the array 
while($row = pg_fetch_row($result)){
  $data[] = $row;
  }

  return $data;
}
function BusesView($hubid) {
  $sql = "SELECT busid FROM bus WHERE hubid = $hubid"; //Setting whatever query you want to run to a string variable 
  $result = pg_query(DbConnect(), $sql) or die("error to fetch data");  
  $data = array(); //Iinitializing ane mpty array 
  
  //If the query returns nothing send error message 
  if (!$result){ 
    echo "An error occured.\n";
    exit;
  }
  //while there is data in each given row add it to the array 
  while($row = pg_fetch_row($result)){
  $data[] = $row;
  }

  return $data;
}
function Add_Bus($hubid) {
  $sql = "insert into bus (hubid) values ($hubid)"; //Setting whatever query you want to run to a string variable
  Bus_info();
}
function Edit_Bus($hubid) {
  $sql = "Alter table bus drop where hubid = $hubid";
}
function RoutesView($hubID) {
  $sql = "SELECT routeid, time, distance, busid, empid FROM route WHERE hubid = $hubID"; //Setting whatever query you want to run to a string variable 
  $result = pg_query(DbConnect(), $sql) or die("error to fetch data");  
  $data = array(); //Iinitializing ane mpty array 
  
  //If the query returns nothing send error message 
  if (!$result){ 
    echo "An error occured.\n";
    exit;
  }
  //while there is data in each given row add it to the array 
  while($row = pg_fetch_row($result)){
  $data[] = $row;
  }

  return $data;
}

function Remove_route($hubid) {
  $sql = "update route where hubid = $hubid"; //Setting whatever query you want to run to a string variable 
}

function Display_Route() {
  $sql = "SELECT route.*, COUNT(stop.routeid) FROM route LEFT OUTER JOIN stop ON (route.routeid = stop.routeid) GROUP BY route.routeid ORDER BY routeid ASC"; //Setting whatever query you want to run to a string variable 
  $result = pg_query(DbConnect(), $sql) or die("error to fetch data");  
  $data = array(); //Iinitializing ane mpty array 
  
  //If the query returns nothing send error message 
  if (!$result){ 
    echo "An error occured.\n";
    exit;
  }
  //while there is data in each given row add it to the array 
  while($row = pg_fetch_row($result)){
  $data[] = $row;
  }
  return $data;
}

function EmpView($tempEmpID) {
  $sql = "SELECT employee.* FROM route RIGHT OUTER JOIN employee ON (route.empid = employee.empid) WHERE routeid = $tempEmpID"; 
  $result = pg_query(DbConnect(), $sql) or die("error to fetch data");  
  $data = array(); //Iinitializing ane mpty array 
  
  //If the query returns nothing send error message 
  if (!$result){ 
    echo "An error occured.\n";
    exit;
  }
  //while there is data in each given row add it to the array 
  while($row = pg_fetch_row($result)){
  $data[] = $row;
  }
  return $data;
}

function StopsView($routeID) {
  $sql = "SELECT stopid, address FROM stop WHERE routeid = $routeID"; //Setting whatever query you want to run to a string variable 
  $result = pg_query(DbConnect(), $sql) or die("error to fetch data");  
  $data = array(); //Iinitializing ane mpty array 
  
  //If the query returns nothing send error message 
  if (!$result){ 
    echo "An error occured.\n";
    exit;
  }
  //while there is data in each given row add it to the array 
  while($row = pg_fetch_row($result)){
  $data[] = $row;
  }

  return $data;
}

function Table_Builder($array){
    foreach ($array as $rowdata){
    echo "<tr>";
        foreach ($rowdata as $coldata){
            echo "<td>".$coldata."</td>";
        }
    echo "</tr>";
    }
}

?>

