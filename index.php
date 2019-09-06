<?php

    include "inc/header.php";

    include "config/database.php";

    try {
        $query = $connection->prepare("SELECT *FROM employees ORDER BY id ASC");
        $query->execute();
        $query->setFetchMode(PDO::FETCH_ASSOC);
        $data = $query->fetchAll();

        // var_dump($data);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

?>

<div class="bottom-margin">
    <a href="create.php"><button>Create Record</button></a>
</div>

<?php
    
if($data > 0):
    
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(empty($_POST["name"]) && empty($_POST["email"]) && empty($_POST["website"])){
            echo "<p class='error'>Please fill up the required field!</p>";
        } else {
            header("Location:index.php");
        }
    }

?>

    <div class="data-container">
        <table>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Website</th>
                <th>Image</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>

            <?php foreach($data as $data) : ?>    
                <tr>
                    <td><?php echo ucwords($data['name']); ?></td>
                    <td><?php echo $data['email']; ?></td>
                    <td><?php echo $data['website']; ?></td>
                    <td>
                        <img src="<?php echo $data['image_path']; ?>" alt="" class="index-image">
                    </td>
                    <td>
                        <a href="edit.php?id=<?php echo $data['id']; ?>">Edit</a>
                    </td>
                    <td>
                        <a href="delete.php?id=<?php echo $data['id']; ?>" onClick="return confirm('Are you sure you want to delete?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>

<?php

else:
    echo "<h2>There is no record!</h2>";
endif;

include "inc/footer.php";

?>
