<?php 
include 'functions.php';  //Includes the php functions from the file functions.php in this file 
// print_r(GetData()); //Calls the GetData function to return the requested data 
$displayBusData = false;
$displayRouteData = false;
$tempBusID;
$tempRouteID;
?> 

<!DOCTYPE html>
<!-- This is be the html page where we will display the data that we retrieve via php -->
<html>
<head>
<link rel="stylesheet" href="styles.css" type="text/css">
</head>
<body>
<div class="navigation">
  <a href="Employees.php">Employees</a>
  <a class="active" href="#">Hubs</a>
  <a href="Routes.php">Routes</a>
</div>

<?php
	if(isset($_POST['viewBuses'])){
		$displayBusData = true;
		if (is_numeric($_POST['tempBusID'])){
			$tempBusID = $_POST['tempBusID'];
		}
	}
?>

<?php
	if(isset($_POST['viewRoutes'])){
		$displayRouteData = true;
		if (is_numeric($_POST['tempRouteID'])){
			$tempRouteID = $_POST['tempRouteID'];
		}
	}
?>

<div class="main_tables">
<table>
<tr><th>Hub ID</th><th>Address</th><th># of Buses</th><th># of Routes</th></tr>
<?php echo Table_Builder(Display_Hub()); ?>
</table>
</div>

<table cellpadding="5">
<tr>
<td><form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"> 
	View buses for hub: <input type="text" name="tempBusID" placeholder="Enter hub ID">
	<input type="submit" name="viewBuses">
</form></td>
<td><form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"> 
	View routes for hub: <input type="text" name="tempRouteID" placeholder="Enter hub ID">
	<input type="submit" name="viewRoutes">
</form></td>
</tr>
</table>

<?php
		if($displayBusData && is_numeric($_POST['tempBusID']))
		{
			echo "<div class=\"secondary_tables\">";
			echo "<table>";
			echo "<tr><th>Bus ID</th></tr>";
			echo Table_Builder(BusesView($tempBusID));
			echo "</table>";
			echo "</div>";
		}
		elseif($displayBusData && !(is_numeric($_POST['tempBusID']))){
			echo "No ID entered.";
		}
?>

<?php
		if($displayRouteData && is_numeric($_POST['tempRouteID']))
		{
			echo "<div class=\"secondary_tables\">";
			echo "<table>";
			echo "<tr><th>Route</th><th>Time (Minutes)</th><th>Distance (miles)</th><th>Bus ID</th><th>Employee ID</th></tr>";
			echo Table_Builder(RoutesView($tempRouteID));
			echo "</table>";
			echo "</div>";
		}
		elseif($displayRouteData && !(is_numeric($_POST['tempRouteID']))){
			echo "No ID entered.";
		}
?>

</body>
</html>