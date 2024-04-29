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
            background-color: #4CAF75;
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
<?php include "includes/footer.php" ?>
<?php include "includes/headers.php" ?>
<?php include "modules/sqlicon_con.php" ?>

<!-- data from database -->
<?php global $usertable, $conn;
$query = "SELECT * FROM $usertable;";
$result = mysqli_query($conn, $query);

// Запит для отримання назви головного ключа
$query_key = "SHOW INDEX FROM $usertable WHERE Key_name = 'PRIMARY'";
$result_key = mysqli_query($conn, $query_key);
$primary_key ="";

if ($result_key->num_rows > 0) {
    $row = $result_key->fetch_assoc();
    $primary_key = $row["Column_name"];
}
else {
    echo "Головний ключ не знайдений";
    error_log("Не знайдено ключа");
}
?>

<main>

    <div>
        <?php
        if ($usertable == "worker_group"){
            echo "<button class='btn'><a href='workers.php?table=worker_group_view'> Cховати неактуальні</a></button>";
        }
        elseif ($usertable == "worker_group_view"){
            echo "<button class='btn'><a href='workers.php?table=worker_group'> Показати усіх</a></button>";

        }
        ?>
                <button class="btn"><a href="modules/create.php?page=<?php echo basename($_SERVER['PHP_SELF']); ?>">&#10133; Новий запис</a></button>
        <?php
        // Функція для виведення даних з таблиці у вигляді HTML-таблиці
        if ($result->num_rows > 0) {
            echo "<table>";
            // Виведення назв стовпців
            echo "<tr>";
            while ($field = $result->fetch_field()) {
                echo "<th>" . $field->name . "</th>";
            }
            if ($usertable == "workers" || $usertable == "worker_group" || $usertable == "worker_group_view")
            {
                echo "<th>Image</th>";
            }
            echo "<th> Action</th>";
            echo "</tr>";
            // Виведення даних
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                foreach ($row as $value) {
                    echo "<td>" . $value . "</td>";
                }
                if ($usertable == "workers")
                {
                    echo "<td><img src='/images/" . $row['id_worker'] . ".jpg' alt='Worker Image' width='75' height='75'></td>";
                }
                elseif ($usertable == "worker_group")
                {
                    if ($row['actual'] == 0)
                    {
                        echo "<td><img src='/images/" . $row['id_worker'] . ".jpg' alt='Worker Image' width='75' height='75' style='filter: grayscale(100%)'></td>";
                    } else {echo "<td><img src='/images/" . $row['id_worker'] . ".jpg' alt='Worker Image' width='75' height='75'></td>";
                    }
                }
                elseif ($usertable == "worker_group_view")
                {
                    echo "<td><img src='/images/" . $row['id_worker'] . ".jpg' alt='Worker Image' width='75' height='75'></td>";
                }
                echo "<td style='text-align: center'>
                            <a href='modules/edit.php?id=$row[$primary_key]&primary_key=$primary_key&page=" . basename($_SERVER['PHP_SELF']) . "'><button>✏️</button></a>
                            <a href='modules/delete.php?id=$row[$primary_key]&primary_key=$primary_key&page=" . basename($_SERVER['PHP_SELF']) . "'><button> &#x1f5d1; </button></a>
                          </td>";


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
</body>
</html>