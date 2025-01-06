<?php
include 'db.php';
session_start();

$user = $_SESSION['user'] ?? null;

if (!$user) {
    header('Location: login.php');
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
    <title>Оформление заказа</title>
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
            flex-direction: column;
            justify-content: flex-start;
            align-items: center;
            min-height: 100vh;
            padding: 40px 20px 20px;
        }

        h1 {
            font-size: 36px;
            color: #5e5e5e;
            margin-bottom: 30px;
            font-weight: 600;
        }

        .order-form-container {
            background-color: #fff;
            padding: 40px 30px;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            width: 100%;
        }

        .order-form-container h2 {
            font-size: 28px;
            color: #333;
            margin-bottom: 20px;
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
            display: flex;
            flex-direction: column;
        }

        label {
            font-size: 16px;
            margin-bottom: 5px;
            color: #555;
        }

        input,
        textarea,
        select {
            width: 100%;
            padding: 12px;
            margin: 5px 0;
            border: 1px solid #ddd;
            background-color: #f9f9f9;
            color: #333;
            font-size: 16px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        input:focus,
        textarea:focus,
        select:focus {
            border-color: #5c6bc0;
            box-shadow: 0 0 5px rgba(92, 107, 192, 0.5);
            outline: none;
        }

        .submit-btn {
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

        .submit-btn:hover {
            background-color: #3f51b5;
            transform: translateY(-2px);
        }

        .submit-btn:active {
            background-color: #303f9f;
            transform: translateY(0);
        }

        .back-link {
            text-align: center;
            margin-top: 20px;
        }

        .back-link a {
            color: #5c6bc0;
            font-weight: 600;
            text-decoration: none;
        }

        .back-link a:hover {
            text-decoration: underline;
        }

        .order-confirmation {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: rgba(0, 0, 0, 0.7);
            color: #fff;
            padding: 30px 40px;
            border-radius: 15px;
            text-align: center;
            font-size: 24px;
            animation: fadeIn 2s forwards;
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
                transform: translate(-50%, -50%) scale(0.5);
            }
            100% {
                opacity: 1;
                transform: translate(-50%, -50%) scale(1);
            }
        }

        @media (max-width: 768px) {
            .order-form-container {
                width: 90%;
                padding: 30px;
            }

            h1 {
                font-size: 28px;
                text-align: center;
            }
        }
    </style>
</head>
<body>

<h1>Оформление заказа</h1>

<div class="order-form-container">
    <h2>Заполните форму для оформления заказа</h2>

    <form id="orderForm" onsubmit="showConfirmation(event)">
        <div class="form-group">
            <label for="full_name">ФИО:</label>
            <input type="text" name="full_name" id="full_name" required placeholder="Введите ваше ФИО">
        </div>

        <div class="form-group">
            <label for="phone">Телефон:</label>
            <input type="tel" name="phone" id="phone" required placeholder="Введите ваш телефон">
        </div>

        <div class="form-group">
            <label for="address">Адрес доставки:</label>
            <textarea name="address" id="address" rows="4" required placeholder="Введите ваш адрес"></textarea>
        </div>

        <div class="form-group">
            <label for="book">Выберите книгу:</label>
            <select name="book" id="book" required>
                <option value="">Выберите книгу</option>
                <?php foreach ($books as $book): ?>
                    <option value="<?= $book['id'] ?>"><?= htmlspecialchars($book['title']) ?> - <?= htmlspecialchars($book['author']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="notes">Примечания:</label>
            <textarea name="notes" id="notes" rows="3" placeholder="Введите дополнительные примечания (по желанию)"></textarea>
        </div>

        <button type="submit" class="submit-btn">Подтвердить заказ</button>
    </form>

    <div class="back-link">
        <a href="main.php">Вернуться на главную</a>
    </div>
</div>

<div class="order-confirmation" id="orderConfirmation">
    Заказ оформлен! <br> Мы скоро свяжемся с вами.
</div>

<script>
    function showConfirmation(event) {
        event.preventDefault(); // Предотвращаем стандартное отправление формы
        const form = document.getElementById('orderForm');
        const confirmation = document.getElementById('orderConfirmation');

        // Показываем анимацию
        confirmation.style.display = 'block';

        // Скрываем форму
        form.style.display = 'none';

        // Не отправляем форму и не перенаправляем на другую страницу
        // Форма остается скрытой, а анимация появляется
    }
</script>

</body>
</html>
