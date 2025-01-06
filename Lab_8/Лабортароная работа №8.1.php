<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Таблица умножения</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 0;
        }

        .navbar {
            background-color: #333;
            padding: 10px 20px;
            color: white;
            text-align: center;
        }

        .navbar a {
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            font-size: 18px;
            margin: 0 10px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .navbar a:hover {
            background-color: #575757;
        }

        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            width: 70%;
            max-width: 800px;
            margin: 30px auto;
            text-align: center;
        }

        h1 {
            color: #333;
            font-size: 36px;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 15px;
            text-align: center;
            font-size: 18px;
        }

        td:hover {
            background-color: #f1f1f1;
        }

        .button-container {
            margin-top: 20px;
        }

        button {
            padding: 15px 30px;
            font-size: 18px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .hidden {
            display: none;
        }
    </style>
    <script>
        function getRandomColor() {
            const letters = '0123456789ABCDEF';
            let color = '#';
            for (let i = 0; i < 6; i++) {
                color += letters[Math.floor(Math.random() * 16)];
            }
            return color;
        }

        function showTable() {
            document.getElementById('multiplication-table').classList.remove('hidden');
            const button = document.querySelector('.navbar a');
            button.style.backgroundColor = getRandomColor();
        }
    </script>
</head>
<body>
    <div class="navbar">
        <a href="#" onclick="showTable()">Показать таблицу умножения</a>
    </div>

    <div class="container">
        <h1>Таблица умножения</h1>
        <div id="multiplication-table" class="hidden">
            <table>
                <tr>
                    <th>x</th>
                    <?php
                        for ($i = 0; $i <= 10; $i++) {
                            echo "<th>" . $i . "</th>";
                        }
                    ?>
                </tr>
                <?php
                    for ($i = 0; $i <= 10; $i++) {
                        echo "<tr>";
                        echo "<th>" . $i . "</th>";
                        for ($j = 0; $j <= 10; $j++) {
                            echo "<td>" . ($i * $j) . "</td>";
                        }
                        echo "</tr>";
                    }
                ?>
            </table>
        </div>
    </div>
</body>
</html>
