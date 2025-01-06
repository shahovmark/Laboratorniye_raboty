<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Адреса магазинов</title>
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
            text-align: center;
        }

        .address-list {
            width: 100%;
            max-width: 900px;
            margin-top: 30px;
        }

        .address-item {
            background-color: #fff;
            padding: 20px;
            margin: 10px 0;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            transition: transform 0.3s ease;
        }

        .address-item:hover {
            transform: translateY(-10px);
        }

        .address-item h3 {
            font-size: 20px;
            color: #333;
            font-weight: 600;
        }

        .address-item p {
            font-size: 14px;
            color: #777;
            margin-top: 5px;
        }

        .back-link {
            margin-top: 40px;
            font-size: 18px;
            text-align: center;
        }

        .back-link a {
            color: #5c6bc0;
            text-decoration: none;
        }

        .back-link a:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            h1 {
                font-size: 28px;
            }

            .address-item h3 {
                font-size: 18px;
            }

            .address-item p {
                font-size: 12px;
            }
        }
    </style>
</head>
<body>

<h1>Адреса наших магазинов</h1>

<div class="address-list">
    <div class="address-item">
        <h3>Москва, Россия</h3>
        <p>ул. Тверская, д. 10, Москва, Россия</p>
    </div>
    <div class="address-item">
        <h3>Нью-Йорк, США</h3>
        <p>5th Ave, New York, NY 10001, USA</p>
    </div>
    <div class="address-item">
        <h3>Лондон, Великобритания</h3>
        <p>Oxford Street, London, W1D 1AN, UK</p>
    </div>
    <div class="address-item">
        <h3>Париж, Франция</h3>
        <p>Rue de Rivoli, 75001 Paris, France</p>
    </div>
    <div class="address-item">
        <h3>Токио, Япония</h3>
        <p>Shibuya, Tokyo, 150-0002, Japan</p>
    </div>
    <div class="address-item">
        <h3>Берлин, Германия</h3>
        <p>Kurfürstendamm, 10707 Berlin, Germany</p>
    </div>
    <div class="address-item">
        <h3>Сидней, Австралия</h3>
        <p>Pitt St, Sydney, NSW 2000, Australia</p>
    </div>
    <div class="address-item">
        <h3>Рим, Италия</h3>
        <p>Via del Corso, 00186 Roma, Italy</p>
    </div>
    <div class="address-item">
        <h3>Барселона, Испания</h3>
        <p>La Rambla, Barcelona, 08002, Spain</p>
    </div>
    <div class="address-item">
        <h3>Сеул, Южная Корея</h3>
        <p>Gangnam, Seoul, 06226, South Korea</p>
    </div>
</div>

<div class="back-link">
    <a href="main.php">Вернуться на главную</a>
</div>

</body>
</html>
