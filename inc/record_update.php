<?php

require_once "config/database.php";

if(isset($_POST['update'])) {
    try {
        function user_input( $data ) {
            $data1 = trim($data);
            $data2 = stripslashes($data1);
            $data3 = htmlspecialchars($data2);
            return $data3;
        }

        $id      = $_POST['id'];
        $name    = user_input($_POST["name"]);
        $email   = user_input($_POST["email"]);
        $website = user_input($_POST["website"]);
        $comment = user_input($_POST["comment"]);

        $db_query = "UPDATE employees
                        SET id = :id, 
                            name = :name,
                            email = :email,
                            website = :website,
                            comment = comment
                        WHERE id = :id"; 
        $query = $connection->prepare($db_query);
        $query->bindParam(':name', $name, PDO::PARAM_STR);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->bindParam(':website', $website, PDO::PARAM_STR);
        $query->bindParam(':comment', $comment, PDO::PARAM_STR);
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->execute();

        header("location: index.php");

    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

?>
