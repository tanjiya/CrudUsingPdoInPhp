<?php include "inc/header.php"; ?>

<div class="bottom-margin">
    <a href="index.php"><button>Back to Record</button></a>
</div>

<div class="form-data">

    <?php
    
        include "inc/record_submit.php";
        
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            if(empty($_POST["name"]) && empty($_POST["email"]) && empty($_POST["website"])){
                echo "<p class='error'>Please fill up the required field!</p>";
            } else {
                echo "<p class='success'>Record has added successfully</p>";
            }
        }
    ?>
    
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
        <div class="bottom-margin">
            <label for="fileToUpload">Upload Image</label>
            <input type="file" name="fileToUpload" id="fileToUpload">
        </div>
        <div>
            <button type="submit" name="submit">Submit</button>
        </div>
    </form>
</div>

<?php include "inc/footer.php"; ?>
