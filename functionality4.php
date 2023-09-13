<!Doctor html>
<html>
<head>
	<title>Employees</title>
	<style>
		body {
			font-family: Arial, sans-serif;
			background-color: #f2f2f2;
		}
		h1 {
			text-align: center;
			margin-top: 50px;
			margin-bottom: 50px;
			color: #333;
		}
		.employee-link {
			display: block;
			width: 400px;
			padding: 20px;
			margin: 20px auto;
			background-color: #fff;
			border: 1px solid #ddd;
			border-radius: 5px;
			box-shadow: 0 2px 2px rgba(0, 0, 0, 0.1);
			text-decoration: none;
			color: #333;
			transition: all 0.3s ease-in-out;
		}
		.employee-link:hover {
			transform: translateY(-5px);
			box-shadow: 0 4px 4px rgba(0, 0, 0, 0.1);
		}
	</style>
</head>
<body>
	<h1>Employees</h1>

<?php
include 'connectdp.php';
echo "<br>";


$sql = "select * from employee";
$stmt = $connection->prepare($sql);
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($results as $row){
	$employeeName = htmlspecialchars($row['FirstName']. ' '. $row['LastName']); // Escape HTML characters
	$scheduleLink = 'schedule.php?employeeId=' . $row['ID']; // Generate link to employee's schedule
	echo '<a href="' . $scheduleLink . '">' . $employeeName . '</a><br>';
}
$connection = null;
?>
</body>
</html>