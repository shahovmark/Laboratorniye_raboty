<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    die("Доступ запрещён!");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $role = $_POST['role'];

    $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username = :username");
    $stmt->execute(['username' => $username]);

    if ($stmt->fetchColumn() > 0) {
        die("Логин уже существует. Выберите другой.");
    }

    $stmt = $pdo->prepare("INSERT INTO users (username, password, role) VALUES (:username, :password, :role)");
    $stmt->execute(['username' => $username, 'password' => $password, 'role' => $role]);

    echo "Новый пользователь добавлен!";
    header('Location: admin.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавление нового пользователя</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #f0f4f8;
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #333;
        }
        .container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding: 30px;
            width: 100%;
            max-width: 400px;
        }
        h1 {
            text-align: center;
            color: #5e5e5e;
            margin-bottom: 20px;
            font-weight: 600;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            color: #555;
        }
        input, select {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            background-color: #f9f9f9;
        }
        input[type="password"], input[type="text"] {
            outline: none;
            transition: all 0.3s ease;
        }
        input[type="password"]:focus, input[type="text"]:focus {
            border-color: #5c6bc0;
            box-shadow: 0 0 5px rgba(92, 107, 192, 0.5);
        }
        select {
            background-color: #fff;
            border-color: #ddd;
        }
        button {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 8px;
            background-color: #5c6bc0;
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #3f51b5;
        }
        button:active {
            background-color: #303f9f;
        }
        .message {
            text-align: center;
            margin-top: 10px;
            font-size: 16px;
            color: #4caf50;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Добавление нового пользователя</h1>
    <form method="post">
        <label for="username">Логин:</label>
        <input type="text" name="username" id="username" required><br>

        <label for="password">Пароль:</label>
        <input type="password" name="password" id="password" required><br>

        <label for="role">Роль:</label>
        <select name="role" id="role">
            <option value="user">User</option>
            <option value="admin">Admin</option>
        </select><br>

        <button type="submit">Добавить пользователя</button>
    </form>
    <?php if (isset($message)) { echo '<div class="message">' . $message . '</div>'; } ?>
</div>

</body>
</html>
