<?php
session_start();
include 'database.php';

// If already logged in, redirect to index.php
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header("Location: index.php");
    exit;
}

// Handle login form submission
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['login'])) {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    // Check credentials in the database
    $stmt = $conn->prepare("SELECT user_id, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($user_id, $hashed_password);

    if ($stmt->num_rows > 0) {
        $stmt->fetch();
        if (password_verify($password, $hashed_password)) {
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['user_id'] = $user_id;
            $_SESSION['username'] = $username;
            header("Location: index.php");
            exit;
        } else {
            $login_error = "Invalid username or password.";
        }
    } else {
        $login_error = "User not found.";
    }
    $stmt->close();
}

// Handle signup form submission
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['signup'])) {
    $username = trim($_POST['new_username']);
    $password = $_POST['new_password'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Check if username already exists
    $stmt = $conn->prepare("SELECT user_id FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $signup_error = "Username already exists.";
    } else {
        // Insert new user
        $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $username, $hashed_password);
        if ($stmt->execute()) {
            $signup_success = "Account created! You can now log in.";
        } else {
            $signup_error = "Error: " . $stmt->error;
        }
    }
    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login & Signup</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-image: url('https://images5.alphacoders.com/134/thumb-1920-1346954.png'); 
            background-size: cover; 
            background-position: center; 
            background-attachment: fixed;
        }
        .hidden { display: none; }
    </style>
    <script>
        function toggleForms() {
            document.getElementById("loginForm").classList.toggle("hidden");
            document.getElementById("signupForm").classList.toggle("hidden");
        }
    </script>
</head>
<body>
<div class="container mt-4">
    <!-- Login Form -->
    <div id="loginForm">
        <h2 class="text-center">Login</h2>
        <form action="" method="POST">
            <input type="hidden" name="login">
            <div class="mb-3">
                <label>Username</label>
                <input type="text" name="username" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <?php if (isset($login_error)) : ?>
                <div class="alert alert-danger"><?= $login_error ?></div>
            <?php endif; ?>
            <button type="submit" class="btn btn-success">Login</button>
        </form>
        <button class="btn btn-primary mt-3"   onclick="toggleForms()">Don't Have an account? Sign Up</button>
    </div>

    <!-- Signup Form -->
    <div id="signupForm" class="hidden">
        <h2 class="text-center">Sign Up</h2>
        <form action="" method="POST">
            <input type="hidden" name="signup">
            <div class="mb-3">
                <label>Username</label>
                <input type="text" name="new_username" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="new_password" class="form-control" required>
            </div>
            <?php if (isset($signup_error)) : ?>
                <div class="alert alert-danger"><?= $signup_error ?></div>
            <?php elseif (isset($signup_success)) : ?>
                <div class="alert alert-success"><?= $signup_success ?></div>
            <?php endif; ?>
            <button type="submit" class="btn btn-success">Sign Up</button>
        </form>
        <button class="btn btn-primary mt-3" onclick="toggleForms()">Already have an account? Login</button></p>
    </div>

</div>
</body>
</html>
