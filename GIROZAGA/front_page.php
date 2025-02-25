<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}
include "database.php";

$books_per_page = 6;

$total_books_sql = "SELECT COUNT(*) AS total_books FROM booksinfo";
$total_books_result = $conn->query($total_books_sql);
$total_books_row = $total_books_result->fetch_assoc();
$total_books = $total_books_row['total_books'];

$total_pages = ceil($total_books / $books_per_page);

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;
if ($page > $total_pages) $page = $total_pages;

$start_limit = ($page - 1) * $books_per_page;

$sql = "SELECT * FROM booksinfo ORDER BY book_ID ASC LIMIT $start_limit, $books_per_page";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Collection</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-image: url('https://images5.alphacoders.com/134/thumb-1920-1346954.png'); 
            background-size: cover; 
            background-position: center; 
            background-attachment: fixed;
        }
        .admin-btn {
            position: absolute;
            top: 20px;
            right: 20px;
        }
        .card {
            height: 100%;
            display: flex;
            flex-direction: column;
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
        .card-body {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .pagination {
            justify-content: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<div class="container mt-4">
    <a href="index.php" class="btn btn-dark admin-btn">Admin</a>
    <h1 class="text-center mb-4">BOOKS LIST</h1>
    <div class="row">
        <?php while ($row = $result->fetch_assoc()) : ?>
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm">
                    <div class="book-cover">
                        <img src="<?= htmlspecialchars($row['cover_image']) ?>" alt="<?= htmlspecialchars($row['book_name']) ?>">
                    </div>
                    <div class="card-body text-center">
                        <h5 class="card-title"><?= htmlspecialchars($row['book_name']) ?></h5>
                        <p class="card-text"><?= htmlspecialchars($row['genre']) ?> | <?= htmlspecialchars($row['date_released']) ?></p>
                        <a href="view.php?id=<?= $row['book_ID'] ?>" class="btn btn-primary">View Details</a>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>

    <nav aria-label="Page navigation">
        <ul class="pagination">
            <?php if ($page > 1): ?>
                <li class="page-item">
                    <a class="page-link" href="front_page.php?page=<?= $page - 1 ?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
            <?php endif; ?>
            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <li class="page-item <?= $i === $page ? 'active' : '' ?>">
                    <a class="page-link" href="front_page.php?page=<?= $i ?>"><?= $i ?></a>
                </li>
            <?php endfor; ?>
            <?php if ($page < $total_pages): ?>
                <li class="page-item">
                    <a class="page-link" href="front_page.php?page=<?= $page + 1 ?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
</div>

</body>
</html>
