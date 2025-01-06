<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header('Location: main.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_book'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];

    $stmt = $pdo->prepare("INSERT INTO books (title, description) VALUES (:title, :description)");
    $stmt->execute(['title' => $title, 'description' => $description]);

    header('Location: redactor.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_book'])) {
    $book_id = $_POST['book_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];

    $stmt = $pdo->prepare("UPDATE books SET title = :title, description = :description WHERE id = :id");
    $stmt->execute(['title' => $title, 'description' => $description, 'id' => $book_id]);

    header('Location: redactor.php');
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM books");
$stmt->execute();
$books = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редактор книг</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { background-color: #f0f4f8; color: #333; font-family: 'Poppins', sans-serif; display: flex; flex-direction: column; align-items: center; padding: 30px; animation: fadeIn 1s ease-out; }
        h1 { font-size: 32px; color: #5e5e5e; margin-bottom: 20px; text-align: center; font-weight: 600; opacity: 0; animation: fadeInText 1.2s forwards; }
        @keyframes fadeIn { 0% { opacity: 0; transform: translateY(20px); } 100% { opacity: 1; transform: translateY(0); } }
        @keyframes fadeInText { 0% { opacity: 0; } 100% { opacity: 1; } }
        .container { width: 100%; max-width: 1200px; display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 20px; padding: 20px; justify-items: center; animation: fadeIn 1.5s ease-out; }
        .book-tile { background-color: #fff; padding: 20px; border-radius: 10px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); width: 100%; max-width: 350px; text-align: center; opacity: 0; animation: slideIn 0.5s ease-out forwards; }
        @keyframes slideIn { 0% { opacity: 0; transform: translateY(20px); } 100% { opacity: 1; transform: translateY(0); } }
        .book-tile h3 { font-size: 20px; color: #333; margin-bottom: 10px; transition: transform 0.3s ease; }
        .book-tile p { font-size: 14px; color: #777; margin-bottom: 15px; height: 60px; overflow: hidden; }
        .book-tile:hover h3 { transform: scale(1.1); }
        .book-tile button { background-color: #5c6bc0; color: white; padding: 8px 16px; border: none; border-radius: 8px; cursor: pointer; transition: background-color 0.3s, transform 0.2s ease-out; animation: buttonAnim 0.3s ease-out; }
        @keyframes buttonAnim { 0% { transform: scale(1); } 100% { transform: scale(1.1); } }
        .book-tile button:hover { background-color: #3f51b5; transform: scale(1.1); }
        .edit-form, .add-form { width: 100%; background-color: #fff; padding: 30px; border-radius: 15px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); margin-top: 30px; max-width: 500px; display: none; opacity: 0; animation: fadeIn 0.6s ease-out forwards; }
        .edit-form input, .edit-form textarea, .add-form input, .add-form textarea { width: 100%; padding: 12px; margin-bottom: 15px; border-radius: 8px; border: 1px solid #ddd; font-size: 16px; transition: all 0.3s ease; }
        .edit-form input:focus, .edit-form textarea:focus, .add-form input:focus, .add-form textarea:focus { border-color: #5c6bc0; background-color: #f9f9f9; }
        .edit-form button, .add-form button { width: 100%; padding: 12px; background-color: #5c6bc0; color: white; border: none; border-radius: 8px; cursor: pointer; transition: background-color 0.3s ease; }
        .edit-form button:hover, .add-form button:hover { background-color: #3f51b5; }
        .back-link { margin-top: 30px; text-align: center; animation: fadeInText 1.2s ease-out forwards; }
        .back-link a { font-size: 16px; color: #5c6bc0; text-decoration: none; transition: color 0.3s; }
        .back-link a:hover { color: #3f51b5; text-decoration: underline; }
        @media (max-width: 768px) { .container { grid-template-columns: 1fr; } .book-tile { width: 90%; margin: 0 auto; } }
    </style>
</head>
<body>

<h1>Редактор книг</h1>

<div class="add-form" id="addForm">
    <h2>Добавить книгу</h2>
    <form method="POST">
        <input type="text" name="title" placeholder="Название книги" required>
        <textarea name="description" rows="4" placeholder="Описание книги" required></textarea>
        <button type="submit" name="add_book">Добавить книгу</button>
    </form>
</div>

<div class="container">
    <?php foreach ($books as $book): ?>
        <div class="book-tile">
            <h3><?= htmlspecialchars($book['title']) ?></h3>
            <p><?= htmlspecialchars($book['description']) ?></p>
            <button data-toggle="edit-form" data-id="<?= $book['id'] ?>">Редактировать</button>
        </div>
    <?php endforeach; ?>
</div>

<div class="edit-form" id="editForm">
    <h2>Редактировать книгу</h2>
    <form method="POST">
        <input type="hidden" name="book_id" id="book_id">
        <input type="text" name="title" id="title" placeholder="Название книги" required>
        <textarea name="description" id="description" rows="4" placeholder="Описание книги" required></textarea>
        <button type="submit" name="edit_book">Сохранить изменения</button>
    </form>
</div>

<div class="back-link">
    <a href="main.php">Вернуться на главную</a>
</div>

<script>
    document.getElementById('addForm').style.display = 'block';

    const buttons = document.querySelectorAll('[data-toggle="edit-form"]');
    const form = document.getElementById('editForm');
    const bookIdInput = document.getElementById('book_id');
    const titleInput = document.getElementById('title');
    const descriptionInput = document.getElementById('description');

    buttons.forEach(button => {
        button.addEventListener('click', (e) => {
            const bookId = e.target.getAttribute('data-id');
            
            fetch('get_book.php?id=' + bookId)
                .then(response => response.json())
                .then(book => {
                    bookIdInput.value = book.id;
                    titleInput.value = book.title;
                    descriptionInput.value = book.description;
                    form.style.display = 'block';
                });
        });
    });
</script>

</body>
</html>
