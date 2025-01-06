<?php
$name = $login = $password = $dob = "";
$nameErr = $loginErr = $passwordErr = $dobErr = "";
$successMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"])) {
        $nameErr = "ФИО обязательно";
    } else {
        $name = $_POST["name"];
    }

    if (empty($_POST["login"])) {
        $loginErr = "Логин обязателен";
    } else {
        $login = $_POST["login"];
    }

    if (empty($_POST["password"])) {
        $passwordErr = "Пароль обязателен";
    } else {
        $password = $_POST["password"];
    }

    if (empty($_POST["dob"])) {
        $dobErr = "Дата рождения обязательна";
    } else {
        $dob = $_POST["dob"];
    }

    if (empty($nameErr) && empty($loginErr) && empty($passwordErr) && empty($dobErr)) {
        $successMessage = "Регистрация прошла успешно!";
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация пользователя</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f8ff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .registration-form {
            background-color: #fff8dc;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 300px;
        }
        .registration-form input, .registration-form button {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        .registration-form button {
            background-color: #ff6347;
            color: white;
            cursor: pointer;
        }
        .registration-form button:hover {
            background-color: #ff4500;
        }
        .error {
            color: #d9534f;
            font-size: 12px;
        }
        .success {
            color: #28a745;
            font-size: 16px;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<div class="registration-form">
    <h2 style="color: #4682b4;">Регистрация</h2>

    <form method="POST">
        <label for="name" style="color: #2f4f4f;">ФИО:</label>
        <input type="text" id="name" name="name" value="<?= htmlspecialchars($name) ?>" required>
        <div class="error"><?= $nameErr ?></div>

        <label for="login" style="color: #2f4f4f;">Логин:</label>
        <input type="text" id="login" name="login" value="<?= htmlspecialchars($login) ?>" required>
        <div class="error"><?= $loginErr ?></div>

        <label for="password" style="color: #2f4f4f;">Пароль:</label>
        <input type="password" id="password" name="password" required>
        <div class="error"><?= $passwordErr ?></div>

        <label for="dob" style="color: #2f4f4f;">Дата рождения:</label>
        <input type="date" id="dob" name="dob" value="<?= htmlspecialchars($dob) ?>" required>
        <div class="error"><?= $dobErr ?></div>

        <button type="submit">Зарегистрироваться</button>
    </form>

    <div class="success"><?= $successMessage ?></div>
</div>

</body>
</html>
