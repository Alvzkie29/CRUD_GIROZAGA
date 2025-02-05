<?php
session_start();
include 'database.php';

if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header("Location: index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $admin_user = "admin";
    $admin_pass = "password"; 
    
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username === $admin_user && $password === $admin_pass) {
        $_SESSION['admin_logged_in'] = true;
        header("Location: index.php");  
        exit;
    } else {
        $error = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-image: url('https://images5.alphacoders.com/134/thumb-1920-1346954.png'); 
            background-size: cover; 
            background-position: center; 
            background-attachment: fixed;
        }
    </style>
</head>
<body>
<div class="container mt-4">
    <h1 class="text-center">ADMIN LOGIN</h1>
    <form action="" method="POST">
        <div class="mb-3">
            <label>Username</label>
            <input type="text" name="username" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <?php if (isset($error)) : ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>

    <div class="mt-3">
        <a href="../front_page.php" class="btn btn-secondary">Back to Front Page</a>
    </div>
</div>
</body>
</html>
