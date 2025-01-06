<?php
include 'db.php';

if (isset($_GET['id'])) {
    $book_id = $_GET['id'];

    $stmt = $pdo->prepare("SELECT * FROM books WHERE id = :id");
    $stmt->execute(['id' => $book_id]);

    $book = $stmt->fetch(PDO::FETCH_ASSOC);
    echo json_encode($book);
}
