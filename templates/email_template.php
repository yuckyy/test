<?php
global $email;
?>
 <!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>6weeks</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f7f7f7;
        }
        .container {
            max-width: 600px;
            margin: auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #333;
            font-size: 24px;
            text-align: center;
        }
        p {
            color: #555;
            font-size: 16px;
            line-height: 1.5;
        }
        .contact-info {
            margin-top: 20px;
            font-weight: bold;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 14px;
            color: #888;
        }
    </style>
</head>
<body>
<div class="container">

    <h1>6weeks</h1>
    <p>Вітаємо, <?= htmlspecialchars($name ?? $email) ?>!</p>
    </p>
    <p></p>

    <div class="contact-info">
        Данні: <br><br>

        Імʼя:<?= htmlspecialchars($name ?? 'Не відомо') ?><br>
        Пошта:<?= htmlspecialchars($email) ?><br>
        Текст:<?= htmlspecialchars($description ?? 'Не відомо') ?><br>
    </div>

    <p>З повагою,<br>Команда 6weeks</p>
</div>
<div class="footer">
    © 2024
</div>
</body>
</html>
