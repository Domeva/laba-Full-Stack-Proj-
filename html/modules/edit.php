<?php include 'sqlicon_con.php';
global $conn;
$filename = "usertable.txt";
$usertable = "";
$fp = fopen($filename,"r");
if ($fp) {
    $usertable=fgets($fp,40);
    fclose($fp);
} else
{                $usertable="";}

error_log("usertable: " . $usertable);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$id = $_GET['id'];
$primary_key = $_GET['primary_key'];
$page = $_GET['page'];
$errorMessage = "";
$successMessage = "";

//Отримання значеннь полів та назв стовпців
$query_tableInfo = "SELECT * From $usertable WHERE $primary_key=$id;";
$result = mysqli_query($conn, $query_tableInfo);
$columns = array();
while ($column = $result->fetch_field()) {
    $columns[] = $column->name;
}
$result = mysqli_query($conn, $query_tableInfo);

//Масив, що зберігає значення полів
$row = mysqli_fetch_assoc($result);
foreach ($row as $value) {
    if ($value == "") {
        $errorMessage = "All fields are required";
        break; // При знаходженні порожнього поля можемо припинити перевірку
    }
}
error_log(print_r($row, true));

if (isset($_POST['submit'])) {
    // Проходимось по кожному ідентифікатору та отримуємо значення з POST
    foreach ($columns as $column) {
        $row[$column] = $_POST[$column];
    }

//Буде зберігати у тексті sql запит
    $setter = '';
// Створення рядка для вставки даних до бази даних
    $fieldsString = implode(", ", $columns); // Поле ідентифікатора
    $valuesString = "'" . implode("', '", $row) . "'"; // Значення полів

    for ($i = 0; $i < count($columns); $i++) {
        $setter .= $columns[$i] . " = '" . $row[$columns[$i]] . "'";
        if ($i < count($columns) - 1) {
            $setter .= ", ";
        }
    }
    $setter = rtrim($setter, ',');
    $id_product = $_GET['id'];
    $primary_key = $_GET['primary_key'];
    $page = $_GET['page'];

    $udQuery = "UPDATE $usertable SET $setter WHERE $primary_key=$id;";
    $run = mysqli_query($conn, $udQuery);

    if (!$run) {
        echo "<script>alert('something wrong')</script>";

    } else {
        header("Location: /$page");
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Введення інформації</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>

<body style="text-align: center;">
<div class="container my-5">
    <h2>Редагування запису</h2>
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
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
        <?php
        // Додавання полів введення на основі назв стовпців
        foreach ($columns as $column) {
            echo "<div class='row mb-3'>";
            echo "<label class='col-sm-3 col-form-label' for='$column'>$column</label>";
            echo "<div class='col-sm-6'>";
            echo "<input type='text' name='$column' placeholder='Enter $column' value='$row[$column]' />";
            echo "</div>";
            echo "</div>"; }

        echo "<div class='row mb-3'>
                    <div class='offset-sm-3 col-sm-3 d-grid'>
                        <input type='submit' name='submit' value='submit' />
                    </div>
                    <div class='col-sm-3 d-grid'>
                        <a class='btn btn-outline-primary' href='/" . $page . "' role='button'>Вийти</a>
                    </div>
                </div>";
        ?>
    </form>
</div>
</body>
</html>