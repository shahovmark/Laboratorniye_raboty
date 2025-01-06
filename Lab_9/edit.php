<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user'])) {
    die("Доступ запрещён!");
}

if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];

    if ($_SESSION['user']['role'] !== 'admin' && $_SESSION['user']['id'] !== $id) {
        die("У вас нет прав для редактирования этого пользователя!");
    }
} else {
    $id = $_SESSION['user']['id']; 
}

$stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id");
$stmt->execute(['id' => $id]);
$user = $stmt->fetch();

if (!$user) {
    die("Пользователь не найден!");
}

$passwordChanged = false; 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_BCRYPT) : $user['password'];

    $role = isset($_POST['role']) ? $_POST['role'] : $user['role']; 

    if ($username !== $user['username']) {
        $checkStmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username = :username AND id != :id");
        $checkStmt->execute(['username' => $username, 'id' => $id]);
        if ($checkStmt->fetchColumn() > 0) {
            $errorMessage = "Логин уже занят!";
        } else {
            $stmt = $pdo->prepare("UPDATE users SET username = :username, password = :password, role = :role WHERE id = :id");
            $stmt->execute(['username' => $username, 'password' => $password, 'role' => $role, 'id' => $id]);

            if (!empty($_POST['password'])) {
                $passwordChanged = true;
            }
        }
    } else {
        $stmt = $pdo->prepare("UPDATE users SET username = :username, password = :password, role = :role WHERE id = :id");
        $stmt->execute(['username' => $username, 'password' => $password, 'role' => $role, 'id' => $id]);

        if (!empty($_POST['password'])) {
            $passwordChanged = true;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редактирование пользователя</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            background-color: #f0f4f8; /* Светлый фон */
            color: #333;
            font-family: 'Poppins', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        h1 {
            font-size: 32px;
            color: #5e5e5e;
            margin-bottom: 20px;
            text-align: center;
            font-weight: 600;
        }

        .container {
            width: 100%;
            max-width: 400px;
            background-color: #fff;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        label {
            font-size: 16px;
            margin-bottom: 5px;
            display: block;
            color: #555;
        }

        input, select, button {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ddd;
            background-color: #f9f9f9;
            color: #333;
            font-size: 16px;
            border-radius: 8px;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        input:focus, select:focus, button:focus {
            outline: none;
            background-color: #f0f0f0;
        }

        button {
            background-color: #5c6bc0;
            color: white;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #3f51b5;
            transform: translateY(-2px);
        }

        .form-footer {
            text-align: center;
            margin-top: 20px;
        }

        .form-footer a {
            color: #5c6bc0;
            text-decoration: none;
        }

        .form-footer a:hover {
            text-decoration: underline;
        }

        .success-message {
            color: #4CAF50;
            font-size: 16px;
            margin-bottom: 20px;
            text-align: center;
        }

        .error-message {
            color: #f44336;
            font-size: 16px;
            margin-bottom: 20px;
            text-align: center;
        }

        @media (max-width: 768px) {
            .container {
                width: 90%;
                padding: 30px;
            }

            h1 {
                font-size: 28px;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Редактирование пользователя</h1>

    <?php if ($passwordChanged): ?>
        <div class="success-message">Пароль изменён!</div>
    <?php elseif (isset($errorMessage)): ?>
        <div class="error-message"><?= $errorMessage ?></div>
    <?php endif; ?>
    
    <form method="post" style="width: 100%;">

        <label for="username">Логин:</label>
        <input type="text" name="username" id="username" value="<?= htmlspecialchars($user['username']) ?>" required>

        <label for="password">Пароль:</label>
        <input type="password" name="password" id="password" placeholder="Оставьте пустым, если не хотите менять">

        <?php if ($_SESSION['user']['role'] === 'admin'): ?>
            <label for="role">Роль:</label>
            <select name="role" id="role">
                <option value="user" <?= $user['role'] === 'user' ? 'selected' : '' ?>>Пользователь</option>
                <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Администратор</option>
            </select>
        <?php endif; ?>

        <button type="submit">Сохранить изменения</button>
    </form>

    <div class="form-footer">
        <a href="dashboard.php">Вернуться на страницу пользователя</a>
    </div>
</div>

</body>
</html>
