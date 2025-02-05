<?php
include "database.php";

//QUERY
try {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $stmt = $conn->prepare("SELECT * FROM booksinfo WHERE book_ID = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $book_name = $_POST['book_name'];
        $genre = $_POST['genre'];
        $date_released = $_POST['date_released'];
        $synopsis = $_POST['synopsis'];
        $reviews = $_POST['reviews'];
        $cover_image = $_POST['cover_image'];

        $stmt = $conn->prepare("UPDATE booksinfo SET book_name = ?, genre = ?, date_released = ?, synopsis = ?, reviews = ?, cover_image = ? WHERE book_ID = ?");
        $stmt->bind_param("ssssssi", $book_name, $genre, $date_released, $synopsis, $reviews, $cover_image, $id);

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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Book</title>
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
    <h2 class="text-center">Edit Book</h2>
    <form action="" method="POST">
        <div class="mb-3">
            <label>Book Name</label>
            <input type="text" name="book_name" class="form-control" value="<?= $row['book_name'] ?>" required>
        </div>
        <div class="mb-3">
            <label>Genre</label>
            <input type="text" name="genre" class="form-control" value="<?= $row['genre'] ?>" required>
        </div>
        <div class="mb-3">
            <label>Release Date</label>
            <input type="date" name="date_released" class="form-control" value="<?= $row['date_released'] ?>" required>
        </div>
        <div class="mb-3">
            <label>Synopsis</label>
            <textarea name="synopsis" class="form-control" required><?= $row['synopsis'] ?></textarea>
        </div>
        <div class="mb-3">
            <label>Reviews</label>
            <textarea name="reviews" class="form-control"><?= $row['reviews'] ?></textarea>
        </div>
        <div class="mb-3">
            <label>Cover Image URL</label>
            <input type="text" name="cover_image" class="form-control" value="<?= $row['cover_image'] ?>" required>
        </div>
        <button type="submit" class="btn btn-warning">Update Book</button>
        <a href="index.php" class="btn btn-secondary">Back</a>
    </form>
</div>
</body>
</html>
