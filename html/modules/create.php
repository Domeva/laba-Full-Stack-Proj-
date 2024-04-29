<?php
// Включення файлу для підключення до бази даних і глобальних змінних
global $conn;
include 'sqlicon_con.php';
$filename = "usertable.txt";
$usertable = "";
$fp = fopen($filename,"r");
if ($fp) {
    $usertable=fgets($fp,40);
    fclose($fp);
} else
{                $usertable="";}

$page = $_GET['page'];

// Отримання імені таблиці
$query_tableInfo = "SELECT * FROM $usertable LIMIT 1;";
$tableInfo = mysqli_query($conn, $query_tableInfo);
$columns = array();
while ($column = $tableInfo->fetch_field()) {
    $columns[] = $column->name;
}

// Масив для зберігання значень полів, ініціалізований порожним
$fieldValues = array();

// Ініціалізація змінних для можливості виведення помилок чи повідомлень про успішність
$errorMessage = "";
$successMessage = "";

// Перевірка, чи прийшли дані методом POST
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $page = $_GET['page'];

    // Проходимось по кожному ідентифікатору та отримуємо значення з POST
    foreach ($columns as $column) {
        $fieldValues[$column] = $_POST[$column];
    }
    // Перевірка, чи всі поля заповнені

    foreach ($fieldValues as $value) {
        if ($value == "") {
            $errorMessage = "All fields are required";
            break; // При знаходженні порожнього поля можемо припинити перевірку
        }
    }
    if ($errorMessage == "") {
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        // Запит для отримання назви головного ключа
        $query_key = "SHOW INDEX FROM $usertable WHERE Key_name = 'PRIMARY'";
        $result_key = mysqli_query($conn, $query_key);
        $primary_key = "";

        if ($result_key->num_rows > 0) {
            $row = $result_key->fetch_assoc();
            $primary_key = $row["Column_name"];
            error_log("PRIMARY: " . $primary_key);
        }
        else {
            echo "Головний ключ не знайдений";
            error_log("Не знайдено ключа");
        }

        $query_is_exist = "SELECT COUNT(*) as count FROM $usertable WHERE $primary_key =  $fieldValues[$primary_key]";
        $result_is_exist = mysqli_query($conn, $query_is_exist);
        $row = $result_is_exist->fetch_assoc();
        $count = $row['count'];

        if ($count > 0) {
            $errorMessage = "Уже існує рядок з таким самим ID";
        }
        else {
            error_log("primaty key: " . $primary_key);
            error_log("field-values key: " . $fieldValues[$primary_key]);
            // Створення рядка для вставки даних до бази даних
            $fieldsString = implode(", ", $columns); // Поле ідентифікатора
            $valuesString = "'" . implode("', '", $fieldValues) . "'"; // Значення полів

            $query_create = "INSERT INTO $usertable ($fieldsString) VALUES ($valuesString)";
            $result_create = mysqli_query($conn, $query_create);

            // Виконання запиту та перевірка на успішність
            if (!$result_create) {
                $errorMessage = "Error:";
            } else {
                $successMessage = "Data inserted successfully";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Введення інформації</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container my-5">
    <h2>Новий запис</h2>
    <?php
    if (!empty($errorMessage)) {
        echo "
        <div class='alert alert-warning alert-dismissible fade show' role='alert'>
            <strong>$errorMessage</strong>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>
        ";
    }

    if (!empty($successMessage)) {
        echo "
        <div class='alert alert-success alert-dismissible fade show' role='alert'>
            <strong>$successMessage</strong>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>
        ";
    }
    ?>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <?php
        // Додавання полів введення на основі назв стовпців
        foreach ($columns as $column) {
            echo "<div class='row mb-3'>";
            echo "<label class='col-sm-3 col-form-label' for='$column'>$column</label>";
            echo "<div class='col-sm-6'>";
            echo "<input type='text' name='$column' placeholder='Enter $column' value='' />";
            echo "</div>";
            echo "</div>"; }

        echo "<div class='row mb-3'>
                    <div class='offset-sm-3 col-sm-3 d-grid'>
                        <button type='submit' class='btn btn-primary'>Підтвердити</button>
                    </div>
                    <div class='col-sm-3 d-grid'>
                        <a class='btn btn-outline-primary' href='/" . $page . "' role='button'>Вийти</a>
                    </div>
                </div>";

        ?>
</div>
</body>
</html>
