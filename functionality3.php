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
    text-align: center;
    padding: 12px;
    border: 1px solid #ddd;
  }

  th {
    background-color: #f2f2f2;
    color: #333;
    font-weight: normal;
    font-size: 16px;
  }

  tr:nth-child(even) {
    background-color: #f9f9f9;
  }
	</style>
</head>
<body>

<?php
include 'connectdp.php';
echo "<br>";

$sql = "SELECT DATE(orderDate) AS od, COUNT(*) AS NumOrders
FROM theorder
GROUP BY DATE(od)
ORDER BY od DESC";

$stmt = $connection->prepare($sql);
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

$connection = null;
?>

<table>
  <thead>
    <tr>
      <th>Dates</th>
      <th>Number of Orders</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($results as $row): ?>
      <tr>
        <td><?php echo $row['od']; ?></td>
        <td><?php echo $row['NumOrders']; ?></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>