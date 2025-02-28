<?php
session_start();
include 'database.php';

if (!isset($_SESSION['admin_logged_in']) && isset($_COOKIE['remember_me'])) {
    $token = $_COOKIE['remember_me'];
    $stmt = $conn->prepare("SELECT user_id, username FROM users WHERE remember_token = ?");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($user_id, $username);

    if ($stmt->num_rows > 0) {
        $stmt->fetch();
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['user_id'] = $user_id;
        $_SESSION['username'] = $username;
    }
}

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}


$details_per_page = 3; 
$total_books_sql = "SELECT COUNT(*) AS total_books FROM booksinfo";
$total_books_result = $conn->query($total_books_sql);
$total_books_row = $total_books_result->fetch_assoc();
$total_books = $total_books_row['total_books'];

$total_pages = ceil($total_books / $details_per_page);

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;
if ($page > $total_pages) $page = $total_pages;


$start_limit = ($page - 1) * $details_per_page;

$sql = "SELECT * FROM booksinfo ORDER BY book_ID ASC LIMIT $start_limit, $details_per_page";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book List</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            background-image: url('https://images5.alphacoders.com/134/thumb-1920-1346954.png'); 
            background-size: cover; 
            background-position: center; 
            background-attachment: fixed;
        }
        .table td, .table th {
            word-wrap: break-word;
            white-space: normal;
            max-width: 500px; 
        }
        .pagination {
            justify-content: center;
            margin-top: 20px;
        }
    </style>
</head>
<body class="bg-light">
<div class="container mt-4">
    <div class="text-center mb-4">
        <h1 class="fa-solid fa-book text-dark bg-light"> BOOKS LIST</h1>
    </div>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Genre</th>
                <th>Release Date</th>
                <th>Synopsis</th>
                <th>My Review</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()) : ?>
                <tr>
                    <td><?= $row['book_ID'] ?></td>
                    <td><?= $row['book_name'] ?></td>
                    <td><?= $row['genre'] ?></td>
                    <td><?= $row['date_released'] ?></td>
                    <td><?= $row['synopsis'] ?></td>
                    <td><?= $row['reviews'] ?></td>
                    <td>
                        <a href="edit.php?id=<?= $row['book_ID'] ?>" class="btn btn-warning btn-sm mb-2">Edit</a>
                        <a href="delete.php?id=<?= $row['book_ID'] ?>" class="btn btn-danger btn-sm mb-2" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <nav aria-label="Page navigation">
        <ul class="pagination">
            <?php if ($page > 1): ?>
                <li class="page-item">
                    <a class="page-link" href="index.php?page=<?= $page - 1 ?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
            <?php endif; ?>
            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <li class="page-item <?= $i === $page ? 'active' : '' ?>">
                    <a class="page-link" href="index.php?page=<?= $i ?>"><?= $i ?></a>
                </li>
            <?php endfor; ?>
            <?php if ($page < $total_pages): ?>
                <li class="page-item">
                    <a class="page-link" href="index.php?page=<?= $page + 1 ?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>

    <div class="d-flex justify-content-start gap-3 mt-4">
        <a href="create.php" class="btn btn-success">Add New Book</a>
        <a href="front_page.php" class="btn btn-secondary">Back to Front Page</a>
        <form method="post">
        <a href="logout.php" class="btn btn-danger">Logout</a>
        </form>
    </div>
</div>
</body>
</html>
