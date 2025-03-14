<?php
session_start();
include "../config/database.php";
include "../config/helper.php";

//require "../config/database.php";

// include_once "../config/database.php";

// require_once "../config/database.php";

// Redirect if not logged in

/*if (!isset($_SESSION["user_id"])) {
    header("Location: ../auth/login.php");
    exit();
}*/

isLoggedIn();
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>User Management</title>
  </head>
  <body>
  <div class="container-fluid">
    <h1>Welcome, <?php echo $_SESSION['user_name']; ?></h1>
    <a href="../auth/logout.php" class="btn btn-danger">Logout</a>
    <h1>Users List</h1>
    <?php //var_dump($_SESSION); start_session(); ?>
    <?php if(isset($_SERVER['error']) && !empty($_SERVER['error'])) : ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $error; ?>
        </div>
    <?php endif; ?>
    <a href="create.php">
        <button class="btn btn-primary">Add User</button>
    </a>
    <table class="table">
    <thead>
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Role</th>
            <th scope="col">phone</th>
            <th scope="col"> Action </th>
        </tr>
    </thead>
    <tbody>
        <?php
            // $sql = "select id, name, email, role, phone from users";
            // $result =  $connection->query($sql);
            // $rows = $result->fetch_all();
            // foreach($rows as $row) {
        ?>
            <!--<tr>
                <th scope="row"><?php //echo $row[0]; ?></th>
                <td><?php //echo $row[1]; ?></td>
                <td><?php //echo $row[2]; ?></td>
                <td><?php //echo $row[3]; ?></td>
            </tr>-->
        <?php
            // }
        ?>

        <?php
           $sql = "select id, name, email, role, phone from users";
           $result =  $connection->query($sql);
           while($row = $result->fetch_assoc()) {
        ?>
            <tr>
                <th scope="row"><?php echo $row['name']; ?></th>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['role']; ?></td>
                <td><?php echo $row['phone']; ?></td>
                <td>
                    <a href='edit.php?id=<?php echo $row['id'];?>' class='btn btn-warning btn-sm'>Edit</a>
                    <a href='delete.php?id=<?php echo $row['id'];?>' class='btn btn-danger btn-sm'>Delete</a>
                </td>
            </tr>
        <?php
            }
        ?>
    </tbody>
    </table>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </div>
  </body>
</html>