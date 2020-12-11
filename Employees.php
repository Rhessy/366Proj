<?php 
include 'functions.php';  //Includes the php functions from the file functions.php in this file 
// print_r(GetData()); //Calls the GetData function to return the requested data 
?> 

<!DOCTYPE html>
<!-- This is be the html page where we will display the data that we retrieve via php -->
<html>
<head>
<link rel="stylesheet" href="styles.css" type="text/css">
</head>
<body>
<div class="navigation">
  <a class="active" href="#">Employees</a>
  <a href="Hubs.php">Hubs</a>
  <a href="Routes.php">Routes</a>
</div>

<!-- Display employees table... -->

<form method="post" action="functions.php" method=> 
	View employee info: <input type="text" name="empID" placeholder="Enter employee ID"><br>
	<input type="submit" name="viewEmployee"><br>
</form>

</body>





</html>
