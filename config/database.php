<?php 

try {
    $db_server   = "mysql:dbname=crud_pdo_in_php; host=localhost";
    $user_name   = "root"; 
    $password    = "root";

    $connection = new PDO($db_server, $user_name, $password);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch (PDOException $e) {
    echo "Connection Error: " . $e->getMessage();
}

?>
