<?php
function generateCalendar($month = null, $year = null) {
    if ($month === null || $year === null) {
        $month = date('m');
        $year = date('Y');
    }

    $firstDay = strtotime("$year-$month-01");
    $numDays = date('t', $firstDay);
    $firstWeekDay = date('N', $firstDay);

    $holidays = [
        "01-01", "07-01", "08-03", "01-05", "09-05", "12-06", "04-11"
    ];

    echo "<table class='calendar'>";
    echo "<thead><tr><th colspan='7'>" . date('F Y', $firstDay) . "</th></tr></thead>";
    echo "<thead><tr><th>Пн</th><th>Вт</th><th>Ср</th><th>Чт</th><th>Пт</th><th>Сб</th><th>Вс</th></tr></thead>";
    echo "<tbody>";

    $currentDay = 1;
    for ($i = 0; $i < 6; $i++) {
        echo "<tr>";
        for ($j = 1; $j <= 7; $j++) {
            if ($i == 0 && $j < $firstWeekDay) {
                echo "<td></td>";
            } else {
                if ($currentDay <= $numDays) {
                    $dateString = sprintf("%02d-%02d", $month, $currentDay);
                    $isWeekend = ($j == 6 || $j == 7);
                    $isHoliday = in_array($dateString, $holidays);
                    $class = ($isWeekend ? ' weekend' : '') . ($isHoliday ? ' holiday' : '');
                    echo "<td class='$class'>$currentDay</td>";
                    $currentDay++;
                } else {
                    echo "<td></td>";
                }
            }
        }
        echo "</tr>";
        if ($currentDay > $numDays) break;
    }

    echo "</tbody>";
    echo "</table>";
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Календарь</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .calendar-container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }
        input, button {
            margin: 10px;
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        button {
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            text-align: center;
            width: 14%;
            font-size: 18px;
        }
        th {
            background-color: #f1f1f1;
        }
        td.weekend {
            background-color: #ffcccc;
        }
        td.holiday {
            background-color: #ffff99;
        }
        td {
            cursor: pointer;
        }
        td:hover {
            background-color: #e0e0e0;
        }
    </style>
</head>
<body>

<div class="calendar-container">
    <form method="GET">
        <input type="number" name="year" placeholder="Год" value="<?= isset($_GET['year']) ? $_GET['year'] : '' ?>" min="1900" max="2100">
        <input type="number" name="month" placeholder="Месяц" value="<?= isset($_GET['month']) ? $_GET['month'] : '' ?>" min="1" max="12">
        <button type="submit">Сформировать календарь</button>
    </form>

    <?php
    $year = isset($_GET['year']) ? $_GET['year'] : null;
    $month = isset($_GET['month']) ? $_GET['month'] : null;
    
    generateCalendar($month, $year);
    ?>
</div>

</body>
</html>


