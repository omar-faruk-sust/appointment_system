<?php
    session_start();
    include "../config/database.php";
    include "../config/helper.php";

    isLoggedIn();

    $id = (int) $_GET['id'];
    $sql = "delete from users where id=$id";

    if($connection->query($sql) === true) {
        header("Location: index.php");
    } else {
        echo "Error: $connection->error";
    }

?>