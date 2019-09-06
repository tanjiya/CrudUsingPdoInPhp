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

        $file_name      = $_FILES["fileToUpload"]["name"];
        $temp_file_name = $_FILES["fileToUpload"]["tmp_name"];
        $file_size      = $_FILES["fileToUpload"]["size"];
        $target_dir     = "uploads/";
        $target_file    = strtolower($target_dir . basename($file_name));
        $upload_ok      = 1;
        $img_file_type  = pathinfo($target_file, PATHINFO_EXTENSION);

        
        if($file_size > 500000) {
            echo "Please enter a file size between 5mb";
            $upload_ok = 0;
        } else {
            //Allow certain file formats
            if($img_file_type != "jpg" && $img_file_type != "png" && $img_file_type != "jpeg" && $img_file_type != "gif") {
                //echo "JPG, PNG, JPEG and GIF files are allowed";
                $upload_ok = 0;
            } else {
                //Check if $upload_ok is set to 0 by an error
                if($upload_ok === 0) {
                    echo "File has not been uploaded";
                } else {
                    if(move_uploaded_file($temp_file_name, $target_file)){
                        $db_query = "UPDATE employees
                                        SET id = :id, 
                                            name = :name,
                                            email = :email,
                                            website = :website,
                                            comment = comment,
                                            image_path = :image_path
                                        WHERE id = :id"; 
                        $query = $connection->prepare($db_query);
                        $query->bindParam(':name', $name, PDO::PARAM_STR);
                        $query->bindParam(':email', $email, PDO::PARAM_STR);
                        $query->bindParam(':website', $website, PDO::PARAM_STR);
                        $query->bindParam(':comment', $comment, PDO::PARAM_STR);
                        $query->bindParam(':image_path',$target_file, PDO::PARAM_STR);
                        $query->bindParam(':id', $id, PDO::PARAM_INT);
                        $query->execute();

                        header("location: index.php");
                    }
                }
            }
        }
            
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

?>
