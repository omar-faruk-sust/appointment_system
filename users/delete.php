<?php
    include "../config/database.php";

    $id = (int) $_GET['id'];
    $sql = "delete from users where id=$id";

    if($connection->query($sql) === true) {
        header("Location: index.php");
    } else {
        echo "Error: $connection->error";
    }
?>