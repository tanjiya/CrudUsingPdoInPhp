<?php

$name_error = $email_error = $comment_error = $website_error = "";
$name = $email = $comment = $website = $fileToUpload = "";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST["submit"]) && empty($_POST["name"])) {
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
 
    /**
     * ====================================================================
     *               File or image upload
     * ====================================================================
     */
    $file_name      = $_FILES["fileToUpload"]["name"];
    $temp_file_name = $_FILES["fileToUpload"]["tmp_name"];
    $file_size      = $_FILES["fileToUpload"]["size"];
    $target_dir     = "uploads/";
    $target_file    = $target_dir . basename($file_name);
    $upload_ok      = 1;
    $img_file_type  = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    //===========Check if image is an actual image or fake image=========
    $check_img = getimagesize($temp_file_name);
    if($check_img !== false) {
        echo "File is an image - " . $check_img["mime"];
        $upload_ok = 1;
    } else {
        echo "File is not an image";
        $upload_ok = 0;
    }

    //Check if file already exists
    if(file_exists($target_file)) {
        echo "File is already uploaded!";
        $upload_ok = 0;
    }

    //Check file size
    if($file_size > 500000) {
        echo "Please enter a file size between 5mb";
        $upload_ok = 0;
    }

    //Allow certain file formats
    if($img_file_type != "jpg" && $img_file_type != "png" && $img_file_type != "jpeg" && $img_file_type != "gif") {
        echo "JPG, PNG, JPEG and GIF files are allowed";
        $upload_ok = 0;
    }

    //Check if $upload_ok is set to 0 by an error
    if($upload_ok === 0) {
        echo "File has not been uploaded";
    } else {
        if(move_uploaded_file($temp_file_name, $target_file)){
            echo "The file has been uploaded";
        } else {
            echo "There was an error in the file";
        }
    }
}

function user_input( $data ) {
    $data1 = trim($data);
    $data2 = stripslashes($data1);
    $data3 = htmlspecialchars($data2);
    return $data3;
}

?>