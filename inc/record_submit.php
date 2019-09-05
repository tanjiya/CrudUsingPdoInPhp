<?php

require_once "config/database.php";

$name_error = $email_error = $comment_error = $website_error = "";
$name = $email = $comment = $website = $fileToUpload = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    try {
        function user_input( $data ) {
            $data1 = trim($data);
            $data2 = stripslashes($data1);
            $data3 = htmlspecialchars($data2);
            return $data3;
        }
        
        if(empty($_POST["name"])) {
            $name_error = "Name is required";
        } else {
            $name = user_input($_POST["name"]);
            
            if(!preg_match("/^[a-zA-Z ]*$/", $name)) {
                $name_error = "Only letter and white space are allowed";
            }
        }
    
        if(empty($_POST["email"])) {
            $email_error = "Email is required";
        } else {
            $email = user_input($_POST["email"]);
    
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $email_error = "Invalid email format";
            }
        }
    
        if(empty($_POST["website"])) {
            $website_error = "Website address is required";
        } else {
            $website = user_input($_POST["website"]);
    
            if(!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $website)) {
                $website_error = "Invalid website URL";
            }
        }
    
        if(empty($_POST["comment"])) {
            $comment = "";
        } else {
            $comment = user_input($_POST["comment"]);
        }
        
        //include "inc/image_upload.php";

        // Query for Insertion
        $db_query = "INSERT INTO employees(
                                    name,
                                    email,
                                    website,
                                    comment )
                                    VALUES(
                                        :name,
                                        :email,
                                        :website,
                                        :comment)";
        $statement = $connection->prepare($db_query);
        $statement->bindParam(':name', $name, PDO::PARAM_STR);
        $statement->bindParam(':email', $email, PDO::PARAM_STR);
        $statement->bindParam(':website', $website, PDO::PARAM_STR);
        $statement->bindParam(':comment', $comment, PDO::PARAM_STR);
        $statement->execute();    
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

    $conn = null;

}

?>
