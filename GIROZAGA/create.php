<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}
include 'database.php';

//QUERY!!
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $book_name = $_POST['book_name'];
    $genre = $_POST['genre'];
    $date_released = $_POST['date_released'];
    $synopsis = $_POST['synopsis'];
    $reviews = $_POST['reviews'];
    $cover_image = $_POST['cover_image'];

    $stmt = $conn->prepare("INSERT INTO booksinfo (book_name, genre, date_released, synopsis, reviews, cover_image) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $book_name, $genre, $date_released, $synopsis, $reviews, $cover_image);

    if ($stmt->execute()) {
        header("Location: index.php");
        exit;
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Book</title>
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
    <h1 class="text-center">ADD NEW BOOK</h1>
    <form action="" method="POST">
        <div class="mb-3">
            <label>Book Name</label>
            <input type="text" name="book_name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Genre</label>
            <input type="text" name="genre" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Release Date</label>
            <input type="date" name="date_released" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Synopsis</label>
            <textarea name="synopsis" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
            <label>Reviews</label>
            <textarea name="reviews" class="form-control"></textarea>
        </div>
        <div class="mb-3">
            <label>Cover Image URL</label>
            <input type="text" name="cover_image" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Add Book</button>
        <a href="index.php" class="btn btn-secondary">Back</a>  
    </form>
</div>
</body>
</html>
