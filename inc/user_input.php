<?php

//Function to filter the form input
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

?>
