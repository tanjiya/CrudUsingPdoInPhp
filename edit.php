<?php
    
    include "inc/header.php";

    $id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');

    require_once "config/database.php";

    include "inc/record_update.php";
    
    try {
        $db_query = "SELECT id, name, email, website, comment, image_path FROM employees WHERE id = '$id' LIMIT 0,1";

        $query = $connection->prepare($db_query);
        $query->bindParam(':id', $id);
        $query->execute();
        $query->setFetchMode(PDO::FETCH_ASSOC);

        $data = $query->fetchAll();

    } catch (PDOException $e) {
        echo $e->getMessage();
    }

    
    foreach($data as $data) :
?>

<div class="form-data">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$id}");?>" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $id; ?>" />
        <div>
            <label for="name">Name</label>
            <input type="text" name="name" id="name" value="<?php echo $data["name"]; ?>">
        </div>
        <div>
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="<?php echo $data['email']; ?>">
        </div>
        <div>
            <label for="website">Website</label>
            <input type="website" name="website" id="website" value="<?php echo $data['website']; ?>">
        </div>
        <div>
            <label for="comment">Comment</label>
            <textarea name="comment" id="comment" value="<?php echo $data['comment']; ?>"></textarea>
        </div>
        <div class="bottom-margin">
            <img src="<?php echo $data['image_path']?>" alt="" class="index-image">
        </div>
        <div class="bottom-margin">
            <input type="file" name="fileToUpload" id="fileToUpload">
        </div>
        <div>
            <button type="submit" name="update">Update</button>
            <a href="index.php"><button>Back to Record</button></a>
        </div>
    </form>
</div>

<?php

    endforeach;
    
    include "inc/footer.php";

?>
