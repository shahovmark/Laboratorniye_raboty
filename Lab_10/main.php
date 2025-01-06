<?php
include 'db.php';
session_start();

$user = $_SESSION['user'] ?? null;  


$stmt = $pdo->prepare("SELECT * FROM books");
$stmt->execute();
$books = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Книжный магазин</title>
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

        .book-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 30px;
            max-width: 1200px;
            width: 100%;
        }

        .book-tile {
            background-color: #fff;
            padding: 20px;
            height: 320px;
            text-align: center;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .book-tile:hover {
            transform: translateY(-10px);
        }

        .book-tile .icon {
            font-size: 50px;
            color: #5c6bc0;
        }

        .book-tile h3 {
            font-size: 20px;
            margin-top: 15px;
            color: #333;
        }

        .book-tile p {
            font-size: 14px;
            color: #777;
            margin-top: 5px;
        }

        .admin-link {
            margin-top: 40px;
            font-size: 18px;
            text-align: center;
        }

        .admin-link a {
            color: #5c6bc0;
            text-decoration: none;
        }

        .admin-link a:hover {
            text-decoration: underline;
        }

       
        .account-link,
        .logout-link {
            position: absolute;
            top: 20px;
            font-size: 16px;
            padding: 12px 30px;
            border-radius: 50px;
            text-decoration: none;
            color: #fff;
            background: linear-gradient(45deg, #6a11cb, #2575fc);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            text-transform: uppercase;
            font-weight: 600;
        }

        .account-link {
            right: 120px; 
        }

        .logout-link {
            right: 20px; 
        }

        .account-link:hover,
        .logout-link:hover {
            background: linear-gradient(45deg, #2575fc, #6a11cb);
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
        }

        .account-link:active,
        .logout-link:active {
            transform: translateY(1px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        }

        
        .order-link,
        .address-link {
            font-size: 18px;
            padding: 15px 35px;
            margin-top: 40px;
            border-radius: 50px;
            background: linear-gradient(45deg, #ff7e5f, #feb47b);
            color: white;
            text-decoration: none;
            font-weight: 600;
            text-align: center;
            display: inline-block;
            transition: all 0.3s ease;
        }

        .order-link:hover,
        .address-link:hover {
            background: linear-gradient(45deg, #feb47b, #ff7e5f);
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }

        .order-link:active,
        .address-link:active {
            transform: translateY(1px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        }

        
        .login-link {
            position: absolute;
            top: 20px;
            left: 20px;
            font-size: 16px;
            padding: 12px 30px;
            border-radius: 50px;
            background: linear-gradient(45deg, #ff6a00, #ff9e00);
            color: white;
            text-decoration: none;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .login-link:hover {
            background: linear-gradient(45deg, #ff9e00, #ff6a00);
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }

        .login-link:active {
            transform: translateY(1px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        }

        
        a {
            text-decoration: none;
        }

        @media (max-width: 768px) {
            h1 {
                font-size: 28px;
                text-align: center;
            }

            .book-container {
                gap: 20px;
            }

            .book-tile {
                width: 100%;
                height: 280px;
            }

            .account-link,
            .logout-link {
                font-size: 14px;
                padding: 10px 20px;
            }

            .order-link,
            .address-link,
            .login-link {
                font-size: 16px;
                padding: 12px 30px;
            }
        }
    </style>
</head>
<body>

<h1>Книжный магазин</h1>

<?php if ($user && $user['role'] === 'admin'): ?>
    <div class="admin-link">
        <p><a href="redactor.php">Перейти к редактору</a></p>
    </div>
<?php endif; ?>

<div class="book-container">


    <?php foreach ($books as $book): ?>
        <div class="book-tile">
            <div class="icon">📚</div>
            <h3><?= htmlspecialchars($book['title']) ?></h3>
            <p><?= htmlspecialchars($book['author']) ?></p>
            <p><?= htmlspecialchars($book['description']) ?></p>
        </div>
    <?php endforeach; ?>
</div>

<?php if ($user): ?>
    <div class="account-link">
        <a href="dashboard.php">Мой аккаунт</a>
    </div>

    <div class="logout-link">
        <a href="logout.php">Выйти</a>
    </div>
<?php else: ?>
    <div class="login-link">
        <a href="login.php">Войти</a>
    </div>
<?php endif; ?>


<div class="order-link">
    <a href="zakaz.php">Оформление заказа</a>
</div>


<div class="address-link">
    <a href="adresa.php">Адреса магазинов</a>
</div>

</body>
</html>
