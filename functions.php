<?php
//Function to retrieve database connection credentials from a specific text file 
function DbCredentials() {
$myfile = fopen("Pg_connect.txt", "r") or die("Unable to open file!");
	$my_host = fgets($myfile);
	$my_dbname = fgets($myfile);
	$my_user = fgets($myfile);
        $my_sslmode = fgets($myfile);
        $my_password = fgets($myfile);
        $DbCred = $my_host.''.$my_dbname.''. $my_user.''.$my_sslmode.''.$my_password;
        fclose($myfile);
        return $DbCred;
}
//Connect to the given database using the credentials returned by the previous function 
function DbConnect (){
 
$db = pg_connect(DbCredentials());
if(!$db){
  echo "An error occured.\n";
  exit;
}
return $db;
}

/*Function to retrieve specific data from a specific table in the given databse, 
it will store the data from the specified table into an array and return the array,
for easy access of the data later
*/

function GetData() {
 $table = 'route';
  
    $sql = "SELECT * FROM $table "; //Setting whatever query you want to run to a string variable 
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


  return $data; //return the data from the database table as an array 
}
    
?>
