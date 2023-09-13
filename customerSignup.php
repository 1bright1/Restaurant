<!Doctor html>
<html>
<body>

<?php
include 'connectdp.php';
echo "<br>";

if ($_SERVER['REQUEST_METHOD'] == 'POST'){	
	$fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $cusEmail = $_POST['email'];
    $cusPhone = $_POST['phone'];
    $addr = $_POST['address'];
    $cusCity = $_POST['city'];
    $zip = $_POST['postal'];
}

$stmt = $connection->prepare("SELECT COUNT(*) FROM customeracct WHERE Email = :email");
$stmt->bindParam(':email', $cusEmail);
$stmt->execute();
$count = $stmt->fetchColumn();
$stmt->fetch();

if($count > 0){
	echo "Customer already exists";
}else{
	$emptyy = null;
	$credit = 5.00;
	$stmt = $connection->prepare("INSERT INTO customeracct (FirstName, LastName, CellNum, delStreet, delCity, delPC, CreditNum, Email, RestaurantN) VALUES (:fname, :lname, :cusPhone, :addr, :cusCity, :zip, :credit, :cusEmail, :emptyy)");
	$stmt->bindParam(':fname', $FirstName);
	$stmt->bindParam(':lname', $LastName);
	$stmt->bindParam(':cusPhone', $CellNum);
	$stmt->bindParam(':addr', $delStreet);
	$stmt->bindParam(':cusCity', $delCity);
	$stmt->bindParam(':zip', $delPC);
	$stmt->bindParam(':credit', $CreditNum);
	$stmt->bindParam(':cusEmail', $Email);
	$stmt->bindParam(':emptyy', $RestaurantN);

	$FirstName= $fname;
	$LastName= $lname;
	$CellNum= $cusPhone;
	$delStreet= $addr;
	$delCity= $cusCity;
	$delPC = $zip;
	$CreditNum= $credit;
	$Email= $cusEmail;
	$RestaurantN= $emptyy;

	if ($stmt->execute()) {
		echo "New user added successfully";
	} else {
		echo "Error adding new user";
	}
}

$connection = NULL;
?>
	