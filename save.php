<?php
require('includes/connection.php');
$client = $_POST['clientName'];
$date = $_POST['date'];
$subTotal = $_POST['sub-total-amount'];
$vat = $_POST['vat'];
$total = $_POST['total-amount'];
$type = $_POST['type'];
$descriptions = $_POST['description'];
$prices = $_POST['price'];
// echo $client;
// echo $date;
$sql = "INSERT INTO `clients` (`id`, `name`) VALUES (null, '$client');";
$conn->query($sql);
$client_id = $conn->insert_id;
$sql = "INSERT INTO `documents` (`id`,`type`,`date`,`client`,`subTotal`,`vat`, `total`,`lastModified`) VALUES ('null','$type','$date','$client_id','$subTotal','$vat','$total','');";
echo $sql;
$conn->query($sql);
$document_id = $conn->insert_id;
$items = array();
for($i = 0; $i < count($_POST['description']); $i++){
	$items[$i]['description'] = $descriptions[$i];
	$items[$i]['amount'] = $prices[$i];
}
$sql = "INSERT INTO `items` (`id`,`description`,`documentID`,`amount`) VALUES";
foreach ($items as $item) {
 $sql .= " ('null','".$item['description']."','$document_id','".$item['amount']."'),";
}
//trim trailing semicolon
$sql = rtrim($sql, ",");
$sql .= ";";
$conn->query($sql);

echo $sql;
// echo $conn->error;
echo "<pre>";
var_dump($items);
echo "</pre>";
?>