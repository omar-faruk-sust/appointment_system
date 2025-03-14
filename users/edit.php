<?php
include "../config/database.php";

$id = $_GET['id'];
$sql = "select * from users where id=$id";
$result = $connection->query($sql);
$user = $result->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2>Edit User</h2>
    <form method="post" action="#">
        <div class="mb-3">
            <label>Name:</label>
            <input type="text" name="name" class="form-control" required value="<?php echo $user['name']; ?>">
        </div>
        <div class="mb-3">
            <label>Email:</label>
            <input type="email" name="email" class="form-control" required <?php echo $user['email']; ?>>
        </div>
        <div class="mb-3">
            <label>Password:</label>
            <input type="password" name="password" class="form-control">
        </div>
        <div class="mb-3">
            <label>Role:</label>
            <?php 
                //var_dump($user['role']);
                //die();
            ?>
            <select name="role" class="form-control">
                <option value="customer" <?php echo $user['role']=='customer' ? 'selected' : ''; ?>>Customer</option>
                <option value="service provider" <?php echo $user['role'] == 'service provider' ? 'selected' : ''; ?>>Provider</option>
                <option value="admin" <?php echo $user['role']=='admin' ? 'selected' : ''; ?>>Admin</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Phone:</label>
            <input type="text" name="phone" class="form-control" required <?php echo $user['phone']; ?>>
        </div>
        <button type="submit" class="btn btn-success">Edit User</button>
        <a href="index.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</body>
</html>