<?php
include 'db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $role = $_POST['role'];

    // Проверяем, существует ли уже такой логин
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username = :username");
    $stmt->execute(['username' => $username]);

    if ($stmt->fetchColumn() > 0) {
        $error = "Логин уже существует. Выберите другой.";
    } else {
        // Вставляем нового пользователя в базу данных
        $stmt = $pdo->prepare("INSERT INTO users (username, password, role) VALUES (:username, :password, :role)");
        $stmt->execute(['username' => $username, 'password' => $password, 'role' => $role]);

        // После успешной регистрации переходим на главную страницу
        header('Location: main.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            background-color: #f0f4f8;
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
            margin-bottom: 40px;
            text-align: center;
            font-weight: 600;
        }

        .container {
            width: 100%;
            max-width: 450px;
            background-color: #fff;
            padding: 40px 30px;
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
            text-align: left;
            width: 100%;
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
            transition: all 0.3s ease;
        }

        input:focus, select:focus, button:focus {
            outline: none;
            background-color: #f0f0f0;
            border-color: #5c6bc0;
            box-shadow: 0 0 5px rgba(92, 107, 192, 0.5);
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

        button:active {
            background-color: #303f9f;
            transform: translateY(0);
        }

        .error {
            color: #f44336;
            font-size: 16px;
            margin-bottom: 20px;
            text-align: center;
        }

        .login-link {
            margin-top: 20px;
            text-align: center;
            font-size: 16px;
        }

        .login-link a {
            color: #5c6bc0;
            text-decoration: none;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        .main-link {
            margin-top: 20px;
            text-align: center;
        }

        .main-link a {
            color: #5c6bc0;
            text-decoration: none;
            font-size: 16px;
        }

        .main-link a:hover {
            text-decoration: underline;
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
    <h1>Регистрация</h1>
    
    <?php if (isset($error)): ?>
        <div class="error"><?= $error ?></div>
    <?php endif; ?>

    <form method="post" style="width: 100%;">
        <div style="width: 100%; display: flex; flex-direction: column; gap: 20px;">
            <div style="display: flex; flex-direction: column;">
                <label for="username">Логин:</label>
                <input type="text" name="username" id="username" placeholder="Введите логин" required>
            </div>

            <div style="display: flex; flex-direction: column;">
                <label for="password">Пароль:</label>
                <input type="password" name="password" id="password" placeholder="Введите пароль" required>
            </div>

            <div style="display: flex; flex-direction: column;">
                <label for="role">Роль:</label>
                <select name="role" id="role" required>
                    <option value="user">Пользователь</option>
                    <option value="admin">Администратор</option>
                </select>
            </div>

            <div style="display: flex; justify-content: center; align-items: center; gap: 10px;">
                <button type="submit">Зарегистрироваться</button>
            </div>
        </div>
    </form>

    <div class="login-link">
        <p>Уже зарегистрированы? <a href="login.php">Войдите здесь</a></p>
    </div>

    <!-- Добавлена ссылка на главную страницу -->
    <div class="main-link">
        <a href="main.php">Главная страница сайта</a>
    </div>
</div>

</body>
</html>
