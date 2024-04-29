<?php include 'sqlicon_con.php';
global $conn;
$filename = "usertable.txt";
$usertable = "";
$fp = fopen($filename,"r");
if ($fp) {
    $usertable=fgets($fp,40);
    fclose($fp);
} else
{$usertable="";}

error_log("usertable: " . $usertable);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


if (isset($_GET['id'], $_GET['primary_key'], $_GET['page'])) {
    $id = preg_replace('/<\?php echo (.+?); \?>/', '$1', $_GET['id']);
    $primary_key = preg_replace('/<\?php echo (.+?); \?>/', '$1', $_GET['primary_key']);

    error_log("id: " . $id . ", primary_key: " . $primary_key);
    $query_delete = "DELETE FROM `$usertable` WHERE `$primary_key`='$id'";
    $result_delete = mysqli_query($conn, $query_delete);

    if (!$result_delete) {
        echo "<script>alert('Error: " . mysqli_error($conn) . "')</script>";
    }
    else {
        $page = $_GET['page'];
        header("Location: /$page");
    }
}
?>
