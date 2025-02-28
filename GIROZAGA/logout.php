<?php
session_start();
include 'database.php';

// Delete the remember_me cookie
setcookie("remember_me", "", time() - 3600, "/");

// Remove token from the database
if (isset($_SESSION['user_id'])) {
    $stmt = $conn->prepare("UPDATE users SET remember_token = NULL WHERE user_id = ?");
    $stmt->bind_param("i", $_SESSION['user_id']);
    $stmt->execute();
}

// Destroy the session and redirect to login
session_destroy();
header("Location: login.php");
exit;
?>
