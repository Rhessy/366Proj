<?php 
include 'functions.php';  //Includes the php functions from the file functions.php in this file 
$passrouteID;
$displayStopsData = false;
$tempEmpID;
$displayEmpData = false;
?> 

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="styles.css" type="text/css">
</head>
<body>
<div class="navigation">
  <a href="Employees.php">Employees</a>
  <a href="Hubs.php">Hubs</a>
  <a class="active" href="#">Routes</a>
</div>

<div class="main_tables">
<table>
<tr><th>Route</th><th>Time (Minutes)</th><th>Distance (miles)</th><th>Bus ID</th><th>Employee ID</th><th>Hub ID</th><th>Stops</th></tr>
<?php echo Table_Builder(Display_Route()); ?>
</table>
</div>

<?php
	if(isset($_POST['viewStop'])){
		$displayStopsData = true;
		if (is_numeric($_POST['tempRouteID'])){
			$passrouteID = $_POST['tempRouteID'];
		}
	}
?>

<?php
	if(isset($_POST['viewEmpData'])){
		$displayEmpData = true;
		if (is_numeric($_POST['tempEmpID'])){
			$tempEmpID = $_POST['tempEmpID'];
		}
	}
?>

<table cellpadding="5">
<tr>
<td><form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"> 
	View stop info for route: <input type="text" name="tempRouteID" placeholder="Enter route ID">
	<input type="submit" name="viewStop">
</form></td>

<td><form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"> 
	View employee info for route: <input type="text" name="tempEmpID" placeholder="Enter route ID">
	<input type="submit" name="viewEmpData">
</form></td>
</tr>
</table>


<?php
		if($displayStopsData && is_numeric($_POST['tempRouteID']))
		{
			echo "<div class=\"secondary_tables\">";
			echo "<table>";
			echo "<tr><th>Stop ID</th><th>Address</th></tr>";
			echo Table_Builder(StopsView($passrouteID));
			echo "</table>";
			echo "</div>";
		}
		elseif($displayStopsData && !(is_numeric($_POST['tempRouteID']))){
			echo "No ID entered.";
		}
?>

<?php
		if($displayEmpData && is_numeric($_POST['tempEmpID']))
		{
			echo "<div class=\"secondary_tables\">";
			echo "<table>";
			echo "<tr><tr><th>ID</th><th>Name</th><th>Address</th><th>Salary</th><th>Birthdate</th><th>Manager ID</th></tr>";
			echo Table_Builder(EmpView($tempEmpID));
			echo "</table>";
			echo "</div>";
		}
		elseif($displayEmpData && !(is_numeric($_POST['tempEmpID']))){
			echo "No ID entered.";
		}
?>

</body>

</html>