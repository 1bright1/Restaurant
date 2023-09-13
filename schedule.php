<!Doctor html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Employee Schedule</title>
	<style>
		body {
			font-family: Arial, sans-serif;
			background-color: #f2f2f2;
		}
		h1 {
			text-align: center;
			margin-top: 50px;
			margin-bottom: 30px;
		}
		table {
			margin: auto;
			border-collapse: collapse;
			width: 80%;
			background-color: #fff;
			box-shadow: 0px 0px 8px #888888;
		}
		th, td {
			text-align: left;
			padding: 10px;
		}
		th {
			background-color: #333;
			color: #fff;
		}
		tr:nth-child(even) {
			background-color: #f2f2f2;
		}
	</style>
</head>
<body>


<?php
include 'connectdp.php';
echo "<br>";

if(isset($_GET['employeeId'])){
	$empID = $_GET['employeeId'];
	$sql = "SELECT * FROM shift where employeeID = :empID AND DAYOFWEEK(day) BETWEEN 2 AND 6";
	$stmt = $connection->prepare($sql);
	$stmt->bindParam(':empID', $empID);
	$stmt->execute();
	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
	  // Display schedule data in a table
	echo '<table>';
	echo '<thead>';
	echo '<tr><th>Date</th><th>Start Time</th><th>End Time</th></tr>';
	echo '</thead>';
	echo '<tbody>';
	foreach ($results as $row) {
		echo '<tr>';
		echo '<td>' . $row['day'] . '</td>';
		echo '<td>' . $row['Starttime'] . '</td>';
		echo '<td>' . $row['Endtime'] . '</td>';
		echo '</tr>';
	}
	echo '</tbody>';
	echo '</table>';
} else {
	echo 'Employee ID not provided.';
}

$connection = null;
