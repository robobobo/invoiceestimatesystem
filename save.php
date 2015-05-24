<?php
require('includes/connection.php');
$client = $_POST['clientName'];
$date = $_POST['date'];
echo $client;
echo $date;
$sql = "INSERT INTO `clients` (`id`, `name`) VALUES (null, '$client');";
$conn->query($sql);
echo $conn->error;

?>