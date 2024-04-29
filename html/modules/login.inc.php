<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $hostname = "localhost";
    $dbName = "test_lab_2";
    $usertable = "product_directory";

    $connection = new mysqli($hostname, $username, $password, $dbName);

    if ($connection->connect_error) {
        header("Location: ../modules/form.php"); // Перенаправлення на форму
        // Завершення виконання скрипту
    }
    else {
        $query_tableInfo = "SELECT * FROM $usertable LIMIT 1;";
        $tableInfo = mysqli_query($connection, $query_tableInfo);
        $columns = array();
        while ($column = $tableInfo->fetch_field()) {
            $columns[] = $column->name;
        }
        $_SESSION['user'] = $username;
        header("Location: ../index.php");
    }
    exit;
}
?>
