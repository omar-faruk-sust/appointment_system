<?php
session_start();

include "../config/database.php";
include "../config/helper.php";

isLoggedIn();

$id = intval($_GET["id"]);
$error = "";

if($_SERVER['REQUEST_METHOD'] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $userId = intval ($_POST['user_id']);
    if ( $id !== $userId) {
        die("Error: User ID mismatch. Possible manipulation detected.");
    }

    //email check
    $emailCheckSql = "select email from users where email = ? and id != ?";
    $statement = $connection->prepare($emailCheckSql);
    $statement->bind_param('si', $email, $id);
    $statement->execute();

    $emailCheckResult = $statement->get_result();
    $emailCount = $emailCheckResult->num_rows;  
    
    if($emailCount > 0) {
        die("Error: Email address is not available.");
        //$_SERVER['error'] = "Email address is not available";
        //header("Location: index.php");
    }
    
    $sql = "update users set name='$name', email='$email', phone='$phone' where id=$id";

    if($connection->query($sql)) {
        header("Location: index.php");
    } else {
        echo "Error: $connection->error";
    }
} else {

    $sql = "select * from users where id = $id";
    $result = $connection->query($sql);
    $user = $result->fetch_assoc();
    var_dump($user);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2>Edit User</h2>
    <?php if(!empty($error)) : ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $error; ?>
        </div>
    <?php endif; ?>

    <form method="post" action="#">
        <div class="mb-3">
            <label>Name:</label>
            <input type="text" name="name" class="form-control" required value="<?php echo $user['name']; ?>">
        </div>
        <div class="mb-3">
            <label>Email:</label>
            <input type="email" name="email" class="form-control" required value="<?php echo $user['email']; ?>">
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
            <input type="text" name="phone" class="form-control" required value="<?php echo $user['phone']; ?>">
        </div>
        <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
        <button type="submit" class="btn btn-success">Edit User</button>
        <a href="index.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</body>
</html>