<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include 'db.php';
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->execute(['username' => $username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user;
        header('Location: main.php'); // Перенаправление на главную страницу
        exit;
    } else {
        echo "<div class='error'>Неверный логин или пароль!</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вход</title>
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
        }

        input {
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

        input:focus {
            border-color: #5c6bc0;
            box-shadow: 0 0 5px rgba(92, 107, 192, 0.5);
            outline: none;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #5c6bc0;
            color: white;
            font-size: 16px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease;
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

        .register-link {
            margin-top: 20px;
            font-size: 16px;
            text-align: center;
        }

        .register-link a {
            color: #5c6bc0;
            text-decoration: none;
            font-weight: 600;
        }

        .register-link a:hover {
            text-decoration: underline;
        }

        .main-link {
            margin-top: 20px;
            font-size: 16px;
            text-align: center;
        }

        .main-link a {
            color: #5c6bc0;
            text-decoration: none;
            font-weight: 600;
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
    <h1>Вход в систему</h1>

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

            <div style="display: flex; justify-content: center; align-items: center; gap: 10px;">
                <button type="submit">Войти</button>
            </div>
        </div>
    </form>

    <div class="register-link">
        <p>Нет аккаунта? <a href="register.php">Зарегистрируйтесь здесь</a></p>
    </div>

    <!-- Ссылка на главную страницу для всех пользователей -->
    <div class="main-link">
        <p><a href="main.php">Перейти на главную страницу</a></p>
    </div>
</div>

</body>
</html>

