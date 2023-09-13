<?php

try{
	$connection = new PDO('mysql:host=localhost:4306;dbname=restaurantdb', 'root', '');
	
	$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	echo "Connected successfully";
} catch(PDOException $e){
	echo "Connection failed: " . $e->getMessage(). "<br/>";
	die();
}
?>