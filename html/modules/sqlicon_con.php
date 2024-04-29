<?php global $usertable;
// Підключення до бази даних
$hostname = "localhost";

session_start();
if (!isset($_SESSION['user']) || empty($_SESSION['user'])) {
    $username = "quest";
} else {
    $username = $_SESSION['user'];
}

switch($username) {
    case 'root':
        $password = "Acer_Aspire_7"; break;
    case 'quest':
        $password = "_Have1not1password_"; break;
    case 'buxalter':
        $password = "Bukaka_675u"; break;
    case 'Ivan':
        $password = "Chupakabra_777"; break;
}

$dbName = "test_lab_2";
$usertable = "";

$filename = "modules/usertable.txt";

// Записуємо значення змінної $usertable у файл usertable.txt (перезаписуємо файл)
switch (basename($_SERVER['PHP_SELF'])) {
    case "count_of_food.php":
        $usertable = "animal_feed_product_storage_view";
        break;
    case "product_directory.php":
        $usertable = "product_directory";
        break;
    case "workers.php":
        if (isset($_GET['table'])) {
            $usertable = $_GET['table'];
        } else{
            $fp = fopen($filename,"r");
            if ($fp) {
                $usertable=fgets($fp,40);
                fclose($fp);
            }
            if ($usertable == "worker_group" || $usertable == "worker_group_view" || $usertable == "machinery_group" || $usertable == "machinery") {}
            else {
                $usertable = "workers";
            }
        }
        break;
}
$fp = fopen($filename,"w");
if ($fp) {
    $ii=fputs($fp,$usertable);
    fclose($fp);
}
$fp = fopen($filename,"r");
if ($fp) {
    $usertable=fgets($fp,40);
    fclose($fp);
} else
{                $usertable="";
}

// Підключення до бази даних
$conn = new mysqli($hostname, $username, $password, $dbName);
// Перевірка з'єднання
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}