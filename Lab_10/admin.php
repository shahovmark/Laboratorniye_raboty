<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    die("Доступ запрещён!");
}

$stmt = $pdo->query("SELECT * FROM users");
$users = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Админ панель</title>
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
            max-width: 900px;
            background-color: #fff;
            padding: 40px 30px;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .button, .logout, .main-page {
            padding: 12px 20px;
            font-size: 16px;
            border-radius: 8px;
            text-decoration: none;
            color: white;
            background-color: #5c6bc0;
            width: 100%;
            text-align: center;
            margin: 10px 0;
            display: inline-block;
        }

        .button:hover, .logout:hover, .main-page:hover {
            background-color: #3f51b5;
        }

        .button-container {
            display: flex;
            justify-content: space-between;
            width: 100%;
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f5f5f5;
            color: #555;
        }

        td {
            background-color: #f9f9f9;
            color: #333;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }

        @media (max-width: 768px) {
            .container {
                width: 90%;
                padding: 30px;
            }

            table {
                font-size: 14px;
            }

            th, td {
                padding: 10px;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Админ панель</h1>

    <a href="adduser.php" class="button">Добавить нового пользователя</a>

    <table>
        <thead>
            <tr>
                <th>Логин</th>
                <th>Роль</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?php echo htmlspecialchars($user['username']); ?></td>
                    <td><?php echo htmlspecialchars($user['role']); ?></td>
                    <td class="button-container">
                        <a href="edit.php?id=<?php echo $user['id']; ?>" class="button">Редактировать</a>
                        <a href="delete.php?id=<?php echo $user['id']; ?>" class="button" onclick="return confirm('Вы уверены, что хотите удалить пользователя?');">Удалить</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <a href="main.php" class="main-page">На главную страницу</a>
    <a href="logout.php" class="logout">Выйти</a>
</div>

</body>
</html>
