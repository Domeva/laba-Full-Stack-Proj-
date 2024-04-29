<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/styles.css">
    <title>Main Page</title>
    <style>
        footer{
            position: fixed;
            bottom: 0;
        }
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
            overflow: auto;
        }
        main {
            text-align: center;
            overflow: auto;
        }

        td,
        th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }

        .btn {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 15px 32px;
            margin: 10px 0;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
        }

        a {
            text-decoration: none;
            color: white;
            font-size: 18px;
        }

    </style>
</head>

<body>
<?php include "includes/nav.php" ?>
<?php include "includes/header.php" ?>

<?php include "modules/sqlicon_con.php" ?>

<!-- data from database -->
<?php global $usertable, $conn;
$query = "SELECT * FROM $usertable;";
$result = mysqli_query($conn, $query);

// Запит для отримання назви головного ключа
$query_key = "SHOW INDEX FROM $usertable WHERE Key_name = 'PRIMARY'";
$result_key = mysqli_query($conn, $query_key);
//$primary_key ="id";

$row = $result_key->fetch_assoc();

//error_log("primary key: " . $primary_key);
?>

<main>
    <div>
        <?php
        // Функція для виведення даних з таблиці у вигляді HTML-таблиці
        if ($result->num_rows > 0) {
            echo "<table>";
            // Виведення назв стовпців
            echo "<tr>";
            while ($field = $result->fetch_field()) {
                echo "<th>" . $field->name . "</th>";
            }
            echo "</tr>";
            // Виведення даних
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                foreach ($row as $value) {
                    echo "<td>" . $value . "</td>";
                }


                echo " </tr>";
            }
            echo "</table>";
        }
        else {
            echo "Немає даних у таблиці";
        }
        ?>
    </div>
</main>
<?php global $counter;
include "includes/footer.php" ?>
</body>
</html>
