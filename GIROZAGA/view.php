<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}

include "database.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM booksinfo WHERE book_ID = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $book = $result->fetch_assoc();
} else {
    echo "Book not found.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($book['book_name']) ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-image: url('https://images5.alphacoders.com/134/thumb-1920-1346954.png'); 
            background-size: cover; 
            background-position: center; 
            background-attachment: fixed;
        }
        .back-btn {
            position: absolute;
            top: 20px;
            left: 20px;
        }
        .book-cover {
            width: 100%;
            height: 500px; 
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .book-cover img {
            width: 100%;
            height: 100%;
            object-fit: cover; 
        }
    </style>
</head>
<body>

<div class="container mt-4">
    <a href="front_page.php" class="btn btn-secondary back-btn">Back</a>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="book-cover">
                    <img src="<?= htmlspecialchars($book['cover_image']) ?>" alt="<?= htmlspecialchars($book['book_name']) ?>">
                </div>
                <div class="card-body">
                    <h2 class="card-title"><?= htmlspecialchars($book['book_name']) ?></h2>
                    <h5 class="text-muted"><?= htmlspecialchars($book['genre']) ?></h5>
                    <p><strong>Release Date:</strong> <?= htmlspecialchars($book['date_released']) ?></p>
                    <p><strong>Synopsis:</strong> <?= nl2br(htmlspecialchars($book['synopsis'])) ?></p>
                    <p><strong>My Review:</strong> <?= nl2br(htmlspecialchars($book['reviews'])) ?></p>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
