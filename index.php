<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PHP Practice</title>
    <style>
        form div{ margin-bottom: 10px; }
        .error { color: red; }
    </style>
</head>
<body>
    <div class="form-data">
        <?php include "form_submit.php"; ?>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
            <div>
                <label for="name">Name</label>
                <input type="text" name="name" id="name">
                <p class="error"><?php echo $name_error; ?></p>
            </div>
            <div>
                <label for="email">Email</label>
                <input type="email" name="email" id="email">
                <p class="error"><?php echo $email_error; ?></p>
            </div>
            <div>
                <label for="website">Website</label>
                <input type="website" name="website" id="website">
                <p class="error"><?php echo $website_error; ?></p>
            </div>
            <div>
                <label for="comment">Comment</label>
                <textarea name="comment" id="comment"></textarea>
            </div>
            <div>
                <input type="file" name="fileToUpload" id="fileToUpload">
            </div>
            <div>
                <button type="submit" name="submit">Submit</button>
            </div>
        </form>
    </div>
    <div class="form-output">
        <p>Name: <?php echo $name; ?></p>
        <p>Email: <?php echo $email; ?></p>
        <p>Comment: <?php echo $comment; ?></p>
        <p>Website:
            <a href="<?php echo $website; ?>" target="_blank">
            <?php echo $website; ?></a>
        </p>
    </div>
</body>
</html>