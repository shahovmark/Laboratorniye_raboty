<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Панель управления</title>
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
            color: #ff7f50; /* Оранжевый акцент */
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

        p {
            font-size: 18px;
            color: #555;
            margin-bottom: 30px;
            text-align: center;
        }

        .button {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ddd;
            background-color: #5c6bc0;
            color: white;
            font-size: 16px;
            border-radius: 8px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
        }

        .button:hover {
            background-color: #3f51b5;
        }

        .logout {
            background-color: #ff7f50; /* Оранжевая кнопка выхода */
            color: white;
            padding: 12px;
            border-radius: 8px;
            margin-top: 20px;
            text-decoration: none;
            text-align: center;
        }

        .logout:hover {
            background-color: #e67e22;
        }

        @media (max-width: 768px) {
            .container {
                width: 90%;
                padding: 30px;
            }

            h1 {
                font-size: 28px;
            }

            p {
                font-size: 16px;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Панель управления</h1>

    <p>Добро пожаловать, <?php echo $_SESSION['user']['username']; ?>!</p>

    <?php if ($_SESSION['user']['role'] === 'admin'): ?>
        <a href="admin.php" class="button">Админ панель</a>
    <?php else: ?>
        <a href="edit.php" class="button">Редактировать профиль</a>
    <?php endif; ?>

    <a href="logout.php" class="logout">Выйти</a>
</div>

</body>
</html>
