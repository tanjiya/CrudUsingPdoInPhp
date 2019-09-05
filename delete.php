<?php

include "config/database.php";

$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');

$db_query = "DELETE FROM employees WHERE id=:id";
$query = $connection->prepare($db_query);
$query->execute(array(':id' => $id));
 
header("Location:index.php");

?>