<?php
session_start();
error_log("Session after: " . $_SESSION['user']);
$active_user = "";

if (!isset($_SESSION['user']) || empty($_SESSION['user'])) {
    $active_user = "Please Log in";
} else {
    $active_user = $_SESSION['user'];
}
?>
<nav>
        <div class="links">
            <a data-active="index" href="index.php">	&#127968; </a>
            <a data-active="index" href="workers.php">Робітники</a>
            <a data-active="index" href="count_of_food.php">Кількість їжі</a>
            <a data-active="index" href="product_directory.php">Довідник товарів</a>
            <a class="login" href="/modules/form.php"> 👤 <?php echo $active_user ?></a>
            <?php
            if ($active_user != "Please Log in") {
                echo "<a class='login' href='/modules/logout.php'>Вихід 🚪 <?php echo $active_user ?></a> ";
            }?>
        </div>
</nav>