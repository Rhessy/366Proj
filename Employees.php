<?php 
include 'functions.php';  //Includes the php functions from the file functions.php in this file 
// print_r(GetData()); //Calls the GetData function to return the requested data
$empID;
$displayEmpData = false;
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

<div class="main_tables">
<table>
<tr><th>Employee ID</th><th>Employee Name</th></tr>
<?php echo Table_Builder(GetEmployeeData()); ?>
</table>
</div>

<?php
	if(isset($_POST['viewEmployee'])){
		$displayEmpData = true;
		if (is_numeric($_POST['tempEmpID'])){
			$empID = $_POST['tempEmpID'];
		}
	}
?>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"> 
	View employee info: <input type="text" name="tempEmpID" placeholder="Enter employee ID"><br>
	<input type="submit" name="viewEmployee"><br>
</form>

<?php
		if($displayEmpData && is_numeric($_POST['tempEmpID']))
		{
			echo "<div class=\"secondary_tables\">";
			echo "<table>";
			echo "<tr><th>ID</th><th>Name</th><th>Address</th><th>Salary</th><th>Birthdate</th><th>Route</th>";
			echo Table_Builder(ManagerView($empID));
			echo "</table>";
			echo "</div>";
		}
		elseif($displayEmpData && !(is_numeric($_POST['tempEmpID']))){
			echo "No ID entered.";
		}
?>

</body>

</html>
