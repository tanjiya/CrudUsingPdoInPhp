<?php

require_once "config/database.php";

$name_error = $email_error = $comment_error = $website_error = "";
$name = $email = $comment = $website = $fileToUpload = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    try {

        include "inc/user_input.php";
        
        $file_name      = $_FILES["fileToUpload"]["name"];
        $temp_file_name = $_FILES["fileToUpload"]["tmp_name"];
        $file_size      = $_FILES["fileToUpload"]["size"];
        $target_dir     = "uploads/";
        $target_file    = strtolower($target_dir . basename($file_name));
        $upload_ok      = 1;
        $img_file_type  = pathinfo($target_file, PATHINFO_EXTENSION);

        //Check if image is an actual image or fake image
        $check_img = getimagesize($temp_file_name);

        if($check_img == false) {
            echo "File is not an image";
            $upload_ok = 0;
        } else {
            //echo "File is an image - " . $check_img["mime"];
            $upload_ok = 1;

            //Check if file already exists
            if(file_exists($target_file)) {
                echo "File is already uploaded!";
                $upload_ok = 0;
            } else {
                //Check file size
                if($file_size > 500000) {
                    echo "Please enter a file size between 5mb";
                    $upload_ok = 0;
                } else {
                    //Allow certain file formats
                    if($img_file_type != "jpg" && $img_file_type != "png" && $img_file_type != "jpeg" && $img_file_type != "gif") {
                        echo "JPG, PNG, JPEG and GIF files are allowed";
                        $upload_ok = 0;
                    } else {
                        //Check if $upload_ok is set to 0 by an error
                        if($upload_ok === 0) {
                            echo "File has not been uploaded";
                        } else {
                            if(move_uploaded_file($temp_file_name, $target_file)){

                                $db_query = "INSERT INTO employees(
                                                            name,
                                                            email,
                                                            website,
                                                            comment,
                                                            image_path)
                                                            VALUES(
                                                                :name,
                                                                :email,
                                                                :website,
                                                                :comment,
                                                                :image_path)";
                                $statement = $connection->prepare($db_query);
                                $statement->bindParam(':name', $name, PDO::PARAM_STR);
                                $statement->bindParam(':email', $email, PDO::PARAM_STR);
                                $statement->bindParam(':website', $website, PDO::PARAM_STR);
                                $statement->bindParam(':comment', $comment, PDO::PARAM_STR);
                                $statement->bindParam(':image_path',$target_file, PDO::PARAM_STR);
                                $statement->execute();
                            }
                        }
                    }
                }
            }
        }
    } catch (PDOException $e) {
            echo $e->getMessage();
    }

    $conn = null;

}

?>
