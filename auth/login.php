<?php
session_start();
include "../config/database.php";

if($_SERVER['REQUEST_METHOD'] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $hasedPassword = sha1($password);
 
    $sql = "select * from users where email=? and password=?";
    $statement = $connection->prepare($sql);
    $statement->bind_param('ss', $email, $hasedPassword);
    $statement->execute();

    $result = $statement->get_result();

    if($result->num_rows == 1) {
        $user = $result->fetch_assoc();

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['role'] = $user['role'];
   
        header("Location: ../users/index.php");
        
    } else {
        $error = "Invalid email or password!";
    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center">
                    <h4>Login</h4>
                </div>
                <div class="card-body">
                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger"><?= htmlspecialchars($error); ?></div>
                    <?php endif; ?>

                    <form method="POST" action="">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" name="email" id="email" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password:</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Login</button>
                    </form>
                </div>
                <div class="card-footer text-center">
                    <a href="register.php">New user? Register</a>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>