<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}
include "database.php";

try {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // QUERY!
        $stmt = $conn->prepare("DELETE FROM booksinfo WHERE book_ID = ?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            header("Location: index.php");
            exit;
        } else {
            echo "Operation failed";
        }
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

?>
