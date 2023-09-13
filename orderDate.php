<!Doctor html>
<html>
<head>
	<style>
	table {
	border-collapse: collapse;
	width: 100%;
	max-width: 800px;
	margin: auto;
	}

	th, td {
	padding: 12px;
	text-align: left;
	border-bottom: 1px solid #ddd;
	}

	th {
	background-color: #f2f2f2;
	font-weight: bold;
	}

	tr:hover {
	background-color: #f5f5f5;
	}

	td:last-child {
	text-align: center;
	}

	td:nth-child(3), td:nth-child(4) {
	font-weight: bold;
	}

	</style>
</head>
<body>


<?php
include 'connectdp.php';
echo "<br>";

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	$thedate = $_POST['Date'];
}
//$thedate = 'Date';
//$thedate = '2023-02-17';
$sql = "SELECT c.FirstName, c.LastName, om.FoodName, om.Price, o.Tip, e.FirstName as 'delivery person first name' , e.LastName as 'delivery person last name'
FROM customeracct c
JOIN theorder o ON c.Email = o.CustEmail
JOIN offermenu om ON o.RestaurantN = om.RestaurantN
JOIN employee e ON o.DeliveryID = e.ID
WHERE o.orderDate = :date";

$stmt = $connection->prepare($sql);
$stmt->bindParam(':date', $thedate);
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
// print the results
//foreach ($results as $row) { 
//    echo "Customer: " . $row['FirstName'] . " " . $row['LastName'] . " " . $row['FoodName'] . " " . $row['Price'] . $row['delivery person first name'] . " " . $row['delivery person first name'] . "<br>";
//    echo "Items Ordered: " . $row['FoodName'] . "<br>";
//    echo "Total Amount: " . $row['Price'] . "<br>";
//    echo "Tip: " . $row['Tip'] . "<br>";
//    echo "Delivery Person: " . $row['delivery person first name'] . " " . $row['delivery person first name'] . "<br>";
//    echo "<br>";
//}
// close the database connection
$connection = null;
?>
<table>
  <thead>
    <tr>
      <th>Customer Name</th>
      <th>Item Ordered</th>
      <th>Total Amount</th>
      <th>Tip</th>
      <th>Delivery Person</th>
    </tr>
  </thead>
  <tbody>
  <tfoot>
    <?php foreach ($results as $row): ?>
      <tr>
        <td><?php echo $row['FirstName'] . " " . $row['LastName']; ?></td>
        <td><?php echo $row['FoodName']; ?></td>
		<td><?php echo "$" . number_format(array_sum(array_column($results, 'Price')), 2); ?></td>
		<td><?php echo "$" . number_format(array_sum(array_column($results, 'Tip')), 2); ?></td>
        <td><?php echo $row['delivery person first name'] . " " . $row['delivery person last name']; ?></td>
      </tr>
	  </tfoot>
    <?php endforeach; ?>
  </tbody>
</table>
