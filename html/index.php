<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/styles.css">
    <title>Main Page</title>
    <style>
        footer{
            position: fixed;
            bottom: 0;
        }
        body, html {
            height: 100%;
            margin: 0;
        }
        body, html {
            height: 100%;
            margin: 0;
        }

        main {
            height: calc(100% - (25%)); /* Визначає висоту main з урахуванням заголовка і футера */
            background-image: url('/images/background.jpg'); /* Замініть шлях на шлях до вашого малюнка */
            background-size: cover; /* Масштабує малюнок так, щоб він повністю відповідав розміру елемента */
            background-position: center; /* Вирівнює малюнок по центру */
        }

    </style>
</head>

<body>
    <?php include "includes/nav.php" ?>
    <?php include "includes/header.php" ?>

    <main></main>

    <?php global $counter;
    include "includes/footer.php" ?>
</body>
</html>
